<html>
<?php include 'base.php' ?>
<body>
<?php 

include 'navbar.php'; 
include 'connection.php'; 


// Generate random transaction ID for a transaction
function random_id()
{

		$length_of_string = 15;
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*';
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result), 0, $length_of_string);
} // end random_id


?>

<div class="container">
	<div style="display: flex">
		<h2 class="h2">Make Transactions</h2>
		<a href='home.php'><button class="btn btn-danger goBack">Go Back</button></a>
	</div>
	<hr class="hr" style='width:50%'>
	<form action="home.php" method="POST">
		<div class="transact mt-5" >
			<div class="input-group ">
			  	<div class="input-group-prepend">
			    	<label class="input-group-text" for="inputGroupSelect01">From</label>
			  	</div>
	  			<select class="custom-select" name='sender_id' id="sender_id" style='width:30%'>
	  				<option selected>Choose...</option>
	  				<?php 

	  					// Display all the customers
	  					$selectQuery = "SELECT * FROM customers ";
							$result = mysqli_query($conn, $selectQuery);
	  					while($row = mysqli_fetch_assoc($result)) {
	  						
		    				echo "<option value=' ". $row['customer_id'] ." '>". $row['customer_name'] ."</option>";
		    			}
	    			?>
	  			</select>
			</div>

			<div class="input-group mt-5 mb-5">
			  	<div class="input-group-prepend">
			    	<label class="input-group-text" for="inputGroupSelect01">To</label>
			  	</div>
	  			<select class="custom-select" name='receiver_id' id="receiver_id" style='width:30%'>
	    			<option selected>Choose...</option>
				    <?php 

				    	// Display all the customers 
				    	$result = mysqli_query($conn, $selectQuery);
				    	while($row = mysqli_fetch_assoc($result)) {
		    				echo "<option class='dropdown-item' value=' ". $row['customer_id'] ." '>". $row['customer_name'] ."</option>
		    					<div class='dropdown-divider'></div>
		    				";

				    	}
	    			?>
	  			</select>
			</div>

			<!--generate random transaction id call random_id function-->			
			<?php $id = random_id(15)  ?>	

			Transaction ID : <input disabled class='form-control' type="text" name="transaction_id" value = '<?php echo $id; ?>' style='width:30%'>
			<input hidden type="text" name="transaction_id" value = '<?php echo $id; ?>'>
			
			<label for='amount' class='form-label mt-5' style='display:inline-flex'>Amount : </label>
			<input type="number" class='form-control' name="amount" style='width:30%'>

			

			<br/>

			<!-- submit the form -->
			<input class="btn btn-primary mt-4 ml-5 mr-5" type="submit" name="submit">

			
		</div>
	</form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>

