<html>

<?php include 'base.php'; ?>

<body>

	<?php 

		include 'navbar.php'; 
		include 'connection.php'; 

		$conn = mysqli_connect($host, $username, $passwd, $dbname);


		if($conn){
			$selectQuery = 'SELECT * FROM transactions_details';
			$result = mysqli_query($conn, $selectQuery);
		}
		else{
			echo "<script>alert('Can't connect to database');</script>";
		}

	?>
	<div class="container">
			<div style="display: flex">
				<h2 class="h2">View Transaction Details</h2>
				<a href='home.php'><button class="btn btn-danger goBack">Go Back</button></a>
			</div>
			<hr class="hr" style='width:55%'>
			<table class='table table-striped' style='width:55%;'>
				<thead>
					<th>Transaction ID</th>
					<th>Sender's Name</th>
					<th>Sender's E-Mail</th>
					<th>Receiver's Name</th>
				</thead>
				<tbody>
					<?php
						
						// display each transaction details
						while($row = mysqli_fetch_assoc($result)){
							echo "
								<tr>
									<td>". $row['transactions_id'] ."</td>
									<td>". $row['sender_name'] ."</td>
									<td>". $row['sender_email'] ."</td>
									<td>". $row['receiver_name'] ."</td>
								</tr>";
						}
					
					?>
				</tbody>
			</table>	
		</div>	

	<?php include 'footer.php'; ?>

</body>
</html>