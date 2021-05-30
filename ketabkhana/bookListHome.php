<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

    <div class="header">
        <?php include 'header2.php';?>
    </div>

    <div class="bg">

      <br>
      <br>
      <br>
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

          echo '<table id= "table">
          
                      <tr>
                        <th>Book Thumbnail</th>
                        <th>Book Id</th>
                        <th>Book Title</th>
                        <th>Book Author</th>
                        <th>Book Publisher</th>
                        <th>Book Edition </th>
                        <th>Book Price</th>
                        <th>Book Store Name </th>
                      </tr>';

          $stmt1 = "select * from bookdata";
          $result = $conn1->query($stmt1);

          if ($result->num_rows != 0)
          {
            while($row = $result->fetch_assoc())     
            {
              //echo "<tbody>";

              echo "<tr>";

              echo '<td> <img src="images/'. $row['thumbnail'] . '" alt="The Adventures of Sherlock Holmes" width="100" height="100" > </td>';

              echo "<td>" . $row['id'] . "</td>";

              echo "<td>" . $row['booktitle'] . "</td>";

              echo "<td>" . $row['bookauthor'] . "</td>";

              echo "<td>" . $row['bookpublisher'] . "</td>";

              echo "<td>" . $row['bookedition'] . "</td>";

              echo "<td>" . $row['bookprice'] . "</td>";

              echo "<td>" . $row['sUname'] . "</td>";

              echo "</tr>";

             //echo "</tbody>";

            }

            echo "</table>";
            echo "<br>";
          }
        }

      ?>

    </div>

    <div class="footer">
      <?php include 'footer.php';?>
    </div>

    <style> 
       
      .bg {
        background-image: url('images/bg.jpg');
        min-height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      } 

    </style>

    </body>
</html>