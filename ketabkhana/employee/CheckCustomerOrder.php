<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

    <div class="header">
        <?php include 'header.php';?>
    </div>

    <div class="bg">

      <br>
      <h1>Customer Orders</h1>

      <?php
      
        $customerErr = "" ;

        $customer = "";
        $flag = 0; 
        $f = 0;

        if(isset($_POST['cart'])){
          if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(empty($_POST['customer'])) {
              $customerErr = "Please fill a valid customer username";
            }
            else {
              $customer = $_POST['customer'];
              $f = 1;
            }
          }

          $host = "localhost";
          $user = "project";
          $pass = "1234";
          $db = "ketabkhana";

          $conn3 = mysqli_connect($host, $user, $pass, $db);
          if(mysqli_connect_error()) {
            echo "Database Connection Failed!";
            echo "<br>";
            echo $conn3 -> connect_error;
          }
          else {
            $stmt3 = mysqli_prepare($conn3, 'delete from cart where userUName = ?');
            mysqli_stmt_bind_param($stmt3, 's', $p10);
            $p10 = $customer;
            mysqli_stmt_execute($stmt3);
          }
          mysqli_close($conn3);

        }


      ?>
      <div class="form">

      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"  method="POST" onsubmit="return validate()">

      <label for="customer">Delete Cart:</label>
      <input type="text" name="customer" id="customer" value="<?php echo $customer;?>" style = "width: 75%; display: inline-block;" placeholder="Enter Username">

      <input type="submit" name="cart" value="Remove" id="srcBtn" style="background-color: #BB2A2A;" >
      <p style="color:red"><?php echo $customerErr; ?></p>

      </form>
      <p id="errorMsg"></p>
    </div>
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
          echo '<table id = "table">
                      <tr>
                        <th>Book ID</th>
                        <th>User Username</th>
                        <th>Shop Username</th>
                        <th>Price</th>
                      </tr>';

          $stmt1 = "select * from cart";
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

    <script>
      function validate() {
        var isValid = false;
        var customer = document.forms["jsForm"]["customer"].value;
      

        if(customer == "") 
        {
          document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
          document.getElementById("errorMsg").style.color = "red";

        
          if(customer == "")
            document.getElementById("customer").style.border = "2px solid red";
          else
            document.getElementById("customer").style.border = "1px solid black";
        }

        else {
          isValid = true;
        }

        return isValid;
      }
  </script>

    </body>
</html>