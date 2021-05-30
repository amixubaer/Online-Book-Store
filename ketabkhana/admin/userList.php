<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

    <div class="header">
        <?php include 'header.php';?>
    </div>

    <div class="bg">

      <br>
      <h1>User List</h1>

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
        else {
          echo '<table id = "table">
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      <th>Email</th>
                    </tr>';

          $stmt1 = "select * from user";
          $result = $conn1->query($stmt1);

          if ($result->num_rows > 0){
            while($row = $result->fetch_assoc())           
            {
               echo "<tr>";

                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['userName'] . "</td>";

                echo "<td>" . $row['firstName'] . "</td>";

                echo "<td>" . $row['lastName'] . "</td>";

                echo "<td>" . $row['gender'] . "</td>";

                echo "<td>" . $row['dob'] . "</td>";

                echo "<td>" . $row['email'] . "</td>";

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
      }

    </style>

    </body>
</html>