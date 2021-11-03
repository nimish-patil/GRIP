<html>
<?php include 'base.php' ?>
<body>
	<?php 
		include 'navbar.php'; 
		include 'connection.php'; 

		// if connection established with database
		if($conn){
			$selectQuery = "SELECT * FROM customers";
			$result = mysqli_query($conn, $selectQuery);
		}
		else{
			echo "<script>alert('Cannot connect to database')</script>";
		}

	?>



		<div class="container">
			<div class='title'>
				<div style="display: flex">
					<h2 class="h2">View Customer Details</h2>
					<a href='home.php'><button class="btn btn-danger goBack">Go Back</button></a>
				</div>
			</div>
			<hr class="hr" style='width:50%'>
			<table class='table table-striped' style='width:50%;'>
				<thead>
					<th>Name</th>
					<th>E-Mail</th>
					<th>Balance</th>
				</thead>
				<tbody>
					<?php
						
						// loop over all the customers and display each data
						while($row = mysqli_fetch_assoc($result)){
							echo "
								<tr>
									<td>". $row['customer_name'] ."</td>
									<td>". $row['email'] ."</td>
									<td>". $row['account_balance'] ." $</td>
								</tr>";
						}
					
					?>
				</tbody>
			</table>	
		</div>	

	<?php include 'footer.php'; ?>
</body>
</html>

