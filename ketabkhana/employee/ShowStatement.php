<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Income Statement</title>
     <link rel="stylesheet" type="text/css" href="../style.css">
 </head>

	<body>
	 
	 	<div class="header">
			<?php include 'header.php';?>
	  	</div>

		<div class="bg">
			<br>
			<h1>Income Statement</h1>
			
			<?php
			
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
          echo '<table id= "infotables">
                      <tr>
                        <th>Date </th>
                        <th>Expenditure</th>
                        <th>Amount</th>
                      </tr>';

          $stmt1 = "select * from statement";
          $result = $conn1->query($stmt1);

          if ($result->num_rows > 0){
              while($row = $result->fetch_assoc())  
              {

                  echo "<tr>";

                  echo "<td>" . $row['date'] . "</td>";

                  echo "<td>" . $row['expenditure'] . "</td>";

                  echo "<td>" . $row['amount'] . "</td>";

                  echo "</tr>";

                  }

                echo "</table>";
              }
          }


			?>
		</div>
	  <div class="footer">
	      <?php include '../footer.php';?>
	  </div>

	  <style>
			
	  	 .bg {
          background-image: url('../images/bg.jpg');
          min-height: 100%; 
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        
        }

        #infotables {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 60%;
        margin: auto;
        color: #34495e;
        border-radius: 30px;
        text-align: center;
        font-weight: bold;
      }

      #infotables td, #infotables th {
        padding: 10px;
      }

      #infotables tr:nth-child(even){background-color: #f2f2f2;}
      #infotables tr:nth-child(odd){background-color: #cdcfd0;}

      #infotables tr:hover {background-color: #ddd;}

      #infotables th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #2e4154;
        color: white;
}

#srcBtn{
        display: inline;
        width: 23%;
        float: right;
        background-color: #eb7d4b;
        text-transform: uppercase;
        border-bottom: 5px solid #c86a40;
        border-radius: 5px;
        cursor: pointer;
      }
		</style>
	</body>

</html>