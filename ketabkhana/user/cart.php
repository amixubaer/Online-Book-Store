<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
 </head>

	<body>
	 
	 	<div class="header">
			<?php include 'header.php';?>
	  	</div>

		<div class="bg">
			<br>
			<h1>My Cart</h1>
			<br>

			<?php

			$uid=$_SESSION['userNameV'];

		
			$host = "localhost";
	        $user = "project";
	        $pass = "1234";
	        $db = "ketabkhana";

	        $conn1 = new mysqli($host, $user, $pass, $db);

	        if($conn1->connect_error) {
	          echo "Database Connection Failed!";
	          echo "<br>";
	          echo $conn1->connect_error;
	        }
	        else 
	        {
			  echo '<table id = "table">
			              
			            <tr>
			                <th>Book Id</th>

			                <th>User Username</th>

			                <th>Shop Username</th>

			                <th>Book Price</th>
			            </tr>';

			$stmt1 = "select * from cart where userUName = '$uid' ";
			$result = $conn1->query($stmt1);

			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc())
			    {

			     echo "<tr>";

			      echo "<td>" . $row['Bid'] . "</td>";

			      echo "<td>" . $row['userUName'] . "</td>";

			      echo "<td>" . $row['shopUName'] . "</td>";

			      echo "<td>" . $row['price'] . "</td>";

			      echo "</tr>";
					}
				}
				echo "</table>";
			}
			?>
		</div>
	  <div class="footer">
	      <?php include 'footer.php';?>
	  </div>

	  <style>
			
				.bg {
					background-image: url('../images/bg.jpg');
					min-height: 100%; 
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
					text-align: center;
				}
				
		</style>
	</body>

</html>