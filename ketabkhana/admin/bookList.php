<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Book List</title>
  </head>
  <body>

    <div class="header">
        <?php include 'header.php';?>
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

          echo '<table id= "customers">
          
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

              echo '<td> <img src="../images/'. $row['thumbnail'] . '" alt="The Adventures of Sherlock Holmes" width="100" height="100" > </td>';

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
        body, html {
        height: 90%;
        margin: 0;
        color: white;
        font-family: candara;
      }

      .bg {
        background-image: url('../images/bg.jpg');
        min-height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .footer{
        color: white;
        height: 7%;
        background-color: #83888A;
      }
      legend{
            text-align: center;
            font-weight: bold;
          }
      h1{
        text-align: center;
      }

      #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 60%;
        margin: auto;
        color: #34495e;
        border-radius: 30px;
        text-align: center;
        font-weight: bold;
      }

      #customers td, #customers th {
        padding: 10px;
      }

      #customers tr:nth-child(even){background-color: #f2f2f2;}
      #customers tr:nth-child(odd){background-color: #cdcfd0;}

      #customers tr:hover {background-color: #ddd;}

      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #2e4154;
        color: white;
}

      

    </style>

    </body>
</html>