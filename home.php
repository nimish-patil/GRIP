<html>
<?php include 'base.php' ?>
<body>

<?php 
	include 'navbar.php';

	// if the method is POST process the transaction before displaying the page contents
	// else display the page contents
	if ($_SERVER['REQUEST_METHOD']=='POST'){
		
		include 'connection.php';

		// if the connection with the database is made
		if ($conn){

			// retrieve data from HTTP POST request
			$sender_id = $_POST['sender_id'];
			$receiver_id = $_POST['receiver_id'];
			$transaction_id = $_POST['transaction_id'];
			$amount = $_POST['amount'];

			// if sender and receiver are the same
			if($sender_id == $receiver_id){
				echo "<script>alert('Sender and Receiver cannot be same')</script>";
			}
			else{

				$selectQuerySender = "SELECT * from customers WHERE customer_id = '$sender_id' ";
				$selectQueryReceiver = "SELECT * from customers WHERE customer_id = '$receiver_id' ";

				// get sender and receiver data from database
				$senderDetail = mysqli_query($conn, $selectQuerySender);
				$receiverDetail = mysqli_query($conn, $selectQueryReceiver);

				$senderD = mysqli_fetch_assoc($senderDetail);
				$receiverD = mysqli_fetch_assoc($receiverDetail);


				$oldSenderBalance = $senderD['account_balance'];
				$oldReceiverBalance = $receiverD['account_balance'];

				$senderName = $senderD['customer_name'];
				$senderEmail = $senderD['email'];
				$receiverName = $receiverD['customer_name'];


				// if the transaction amount is greater than the account balance do not proceed!
				if($amount>$oldSenderBalance){
					echo "<script>alert('Transaction Failed! Entered amount greater than your account balance!!');</script>";
				} 
				
				else{

					// new balance of sender and receiver
					$newBalanceSender = $oldSenderBalance - $amount;
					$newBalanceReceiver = $oldReceiverBalance + $amount;

					$updateQuerySender = "UPDATE customers SET account_balance=$newBalanceSender WHERE customer_id = $sender_id ";
					$updateQueryReceiver = "UPDATE customers SET account_balance=$newBalanceReceiver WHERE customer_id = $receiver_id ";


					// update account balance
					$resultSender = mysqli_query($conn, $updateQuerySender);
					$resultReceiver = mysqli_query($conn, $updateQueryReceiver);

					// create transaction
					$insertQueryTransaction = "INSERT INTO transactions_details (`transactions_id`, `sender_name`, `sender_email`, `receiver_name`, `amount`) VALUES ('$transaction_id', '$senderName', '$senderEmail', '$receiverName', '$amount')";

					$resultTransaction = mysqli_query($conn, $insertQueryTransaction);

					// display success message
					if($resultReceiver && $resultSender && $resultTransaction){
						echo "<script>alert('Transaction Completed!')</script>";
					}
					// or if any error occurs display error message
					else{
						echo "<script>alert(Transaction Failed :( ')</script>";
					}

				}
				
			}
		}
		else{
			echo "Can't connect to database";
		}
	}

?>

<!-- content displayed on the page -->
<div class="container">
	<div class="main">
		<a href='viewCustomers.php'><button class='btn button'><span>View Customers </span></button></a>
		<a href='makeTransactions.php'><button class='btn button' ><span>Make Transaction </span></button></a>
		<br/>
		<a href='viewTransactions.php'><button class='btn button' style='margin-left:14rem;'><span>View Transaction </span></button></a>
	</div>

</div>

<?php include 'footer.php'; ?>

<script>
</script>

</body>
</html>