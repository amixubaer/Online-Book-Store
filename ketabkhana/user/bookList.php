<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

    <div class="header">
        <?php include 'header.php';?>
    </div>

    <div class="bg">

      <br>
    	<h1>Book List</h1>
      <br>

      <?php
      
        $bookIdErr = "" ;


        $bookId = "";
        $userUName = $_SESSION['userNameV'];
        $shopUName = "";
        $price = "";
        $flag = 0; 
        $f = 0;

        if(isset($_POST['cart']))
        {
          if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(empty($_POST['crtB'])) {
              $bookIdErr = "Please fill a valid Book ID";
            }
            else {
              $bookId = $_POST['crtB'];
              $f = 1;
            }

          }

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

            $stmt1 = $conn1->prepare("select id, sUName, bookprice from bookdata where id = ?");
            $stmt1->bind_param("i", $p1);
            $p1 = $bookId;
            $stmt1->execute();
            $res2 = $stmt1->get_result();
            $DBbook = $res2->fetch_assoc();

            
            $id = $DBbook['id'];
            $price = $DBbook['bookprice'];
            $shopUName = $DBbook['sUName'];

            
            if($shopUName != "")
              $flag = 1;
          }

            if($flag==0)
              echo $bookId." not found";

          mysqli_close($conn1);

          if($flag == 1)
          {

          	$host = "localhost";
      			$user = "project";
      			$pass = "1234";
      			$db = "ketabkhana";

      			$conn = new mysqli($host, $user, $pass, $db);

      			if($conn->connect_error) {
      				echo "Database Connection Failed!";
      				echo "<br>";
      				echo $conn->connect_error;
      			}
      			else {
      				
      				$stmt = $conn->prepare("insert into cart (Bid, userUName, shopUName, price) VALUES (?, ?, ?, ?)");
      				$stmt->bind_param("isss", $p2, $p3, $p4, $p5);
      				
      				$p2 = $id;
      				$p3 = $userUName;
      				$p4 = $shopUName;
      				$p5 = $price;
      				
      				$status = $stmt->execute();

      				if($status) 
              {
      				}
      				else {
      					echo "Failed to Insert Data.";
      					echo "<br>";
      					echo $conn->error;
      				}
      			}

      			$conn->close();

          }

      }
          

      ?>
      <div class="form">

      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

      <label for="crtB">Cart Book:</label>
      <input type="text" name="crtB" id="crtB" value="<?php echo $bookId;?>" style = "width: 75%; display: inline-block;">

      <input type="submit" name="cart" value="Add" id = "srcBtn"class="srcBmployeeBtn">
      <p style="color:red"><?php echo $bookIdErr; ?></p>

    </form>
    <p id="errorMsg"></p>
  </div>
    <br>

      <?php

        $host = "localhost";
        $user = "project";
        $pass = "1234";
        $db = "ketabkhana";

        $conn2 = new mysqli($host, $user, $pass, $db);

        if($conn2->connect_error) {
          echo "Database Connection Failed!";
          echo "<br>";
          echo $conn2->connect_error;
        }
        else
        {

          echo '<table id= "table" >
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

            $stmt2 = "select * from bookdata";
            $result = $conn2->query($stmt2);

            if ($result->num_rows > 0)
            {
              while($row = $result->fetch_assoc())     
              {
                echo "<tr>";

                echo '<td> <img src="../images/'. $row['thumbnail'] . '" alt="The Adventures of Sherlock Holmes" width="200" height="200" > </td>';

                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['booktitle'] . "</td>";

                echo "<td>" . $row['bookauthor'] . "</td>";

                echo "<td>" . $row['bookpublisher'] . "</td>";

                echo "<td>" . $row['bookedition'] . "</td>";

                echo "<td>" . $row['bookprice'] . "</td>";

                echo "<td>" . $row['sUname'] . "</td>";

                echo "</tr>";

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
        background-image: url('../images/bg.jpg');
        min-height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      #submit{
        padding: 10px 50px
      }
     
    </style>

      <script>
    function validate() {
      var isValid = false;
      var addcart = document.forms["jsForm"]["crtB"].value;

      if(addcart == "") {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";

        if(addcart == "")
          document.getElementById("crtB").style.border = "2px solid red";
        else
          document.getElementById("crtB").style.border = "1px solid black";
        
      }
      else {
        isValid = true;
      }

      return isValid;
    }
  </script>

    </body>
</html>