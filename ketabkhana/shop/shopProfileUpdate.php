<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Shop Profile</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

 <div class="header">
      <?php include 'header.php';?>
  </div>

    <div class="bg">
      <br>
 
    <?php

      $srcAErr = $shopNameErr = $shopAddressErr = $idErr = $userNameErr=  $emailErr = $passwordErr= $confirmpassErr="";


		    $srcA = "";
        $shopName = ""; 
        $shopAddress = "";
        $id = "";
        $userName= "";
        $email = "";
        $password= "";
        $confirmpass= "";
        $flag = 0;
	      $searchKey = $_SESSION['userNameV'];


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

        $stmt1 = $conn1->prepare("select shopName, shopAddress, id, userName, email, password, confirmpass from shopdata where userName = ?");
        $stmt1->bind_param("s", $p1);
        $p1 = $searchKey;
        $stmt1->execute();
        $res2 = $stmt1->get_result();
        $shopdata = $res2->fetch_assoc();

        $shopName = $shopdata['shopName'];
        $shopAddress = $shopdata['shopAddress'];
        $id = $shopdata['id'];
        $email = $shopdata['email'];
        $userName = $shopdata['userName'];
        $password = $shopdata['password'];
        $confirmpass = $shopdata['confirmpass'];
        
      }

      mysqli_close($conn1);
      



		if((isset($_POST['update']))||(isset($_POST['delete'])))
	      {

      	 if($_SERVER["REQUEST_METHOD"] == "POST") 
      	 {
      	
      		if(empty($_POST['shopName'])) 
      		{
        $shopNameErr = "Please fill up the shop name properly";
      }
      else {
        $shopName = $_POST['shopName'];
      }

      if(empty($_POST['shopAddress'])) {
        $shopAddressErr = "Please fill up the shop address properly";
      }
      else {
        $shopAddress = $_POST['shopAddress'];
      } 

       if(empty($_POST['email'])) {
        $emailErr = "Email is required";
      }
      else {
        $email = $_POST['email'];
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { $emailErr = "Invalid email format"; }
             }
 
           if(empty($_POST['password'])) {
        $passwordErr = "Please fill up the password properly";
      }
      else {
        $password = $_POST['password'];
      }
           if(empty($_POST['confirmpass'])) {
        $confirmpassErr = "Please fill up the password properly";
      }
      else {
        $confirmpass = $_POST['confirmpass'];
      }
      if($password!==$confirmpass)
      {
        $confirmpassErr="Password don't match";
      }

    }

	  if(isset($_POST['update']) && $password==$confirmpass)
        {

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

          else{
            $stmt2 = mysqli_prepare($conn2, 'update shopdata set shopName = ?, shopAddress = ?, email = ?, password = ?, confirmpass = ? where userName=?');

            mysqli_stmt_bind_param($stmt2, 'ssssss', $p2, $p3, $p4, $p5, $p6, $p7);

            $p2 = $shopName;
            $p3 = $shopAddress;
            $p4 = $email;
            $p5 = $password;
            $p6 = $confirmpass;
            $p7 = $searchKey;

            mysqli_stmt_execute($stmt2);
          }

          mysqli_close($conn2);

        }

        if(isset($_POST['delete']))
        {
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
            echo "Database Connection Successful!";
            $stmt3 = mysqli_prepare($conn3, 'delete from shopdata where userName=?');
            mysqli_stmt_bind_param($stmt3, 's', $p10);
            $p10 = $searchKey;
            mysqli_stmt_execute($stmt3);
          }
          mysqli_close($conn3);

          header("location:../logout.php");

        }

        }
        
      ?>

      <div class="form" style="margin: 5vh auto;">
        <h1>Shop Profile </h1>

  <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"onsubmit="return validate()" method="POST">

    <fieldset>
      <legend> Basic Information :</legend>

       <label for="shopName">Shop Name :</label>
       <input type="text" name="shopName" id="shopName" value="<?php echo $shopName; ?>"> 
       <p style="color:red"><?php echo $shopNameErr; ?></p>

       <label for="shopAddress">Shop Address :</label>
       <input type="text" name="shopAddress" id="shopAddress" value="<?php echo $shopAddress ?>">
       <p style="color:red"><?php echo $shopAddressErr; ?></p>

       <label for="email">Email :</label>
       <input type="email" name="email" id="email" value="<?php echo $email ?>">
       <p style="color:red"><?php echo $emailErr; ?></p>

    </fieldset>

    <fieldset>
      <legend> User Account Information :</legend>

       <label for="id">Id :</label>
       <input type="text" name="id" id="id" value="<?php echo $id; ?>" disabled> 
       <p style="color:red"><?php echo $idErr; ?></p>
    
       <label for="userName">Username :</label>
       <input type="text" name="userName" id="userName" value="<?php echo $userName; ?>" disabled> 
       <p style="color:red"><?php echo $userNameErr; ?></p>
    
       <label for="password">Password :</label>
       <input type="password" name="password" id="password" value="<?php echo $password; ?>"> 
       <p style="color:red"><?php echo $passwordErr; ?></p>

        <label for="confirmpass">Re-Type Password :</label>
       <input type="password" name="confirmpass" id="confirmpass" value="<?php echo $confirmpass; ?>"> 
       <p style="color:red"><?php echo $confirmpassErr; ?></p>

    </fieldset>
      <br>

      <input type="submit" name="update" value="Update" id="updateBtn">

      <input type="submit" name="delete" value="Delete" id="deleteBtn">

    </form>
    <p id="errorMsg"></p>
    </div>
      <br>

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

        <script>
          function validate() {
          var isValid = false;

          var shopName = document.forms["jsForm"]["shopName"].value;
          var shopAddress = document.forms["jsForm"]["shopAddress"].value;
          var email = document.forms["jsForm"]["email"].value;
          var id = document.forms["jsForm"]["id"].value;
          var userName = document.forms["jsForm"]["userName"].value;
          var password = document.forms["jsForm"]["password"].value;
          var confirmpass = document.forms["jsForm"]["confirmpass"].value;

      if(shopName == "" || shopAddress == "" || email== ""|| id== "" || userName== ""|| password== "" || confirmpass== "") 

      {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";


        if(shopName == "")
          document.getElementById("shopName").style.border = "2px solid red";
        else
          document.getElementById("shopName").style.border = "1px solid black";


        if(shopAddress == "")
        document.getElementById("shopAddress").style.border = "2px solid red";
        else
          document.getElementById("shopAddress").style.border = "1px solid black";


         if(email == "")
        document.getElementById("email").style.border = "2px solid red";
        else
          document.getElementById("email").style.border = "1px solid black";


         if(id == "")
        document.getElementById("id").style.border = "2px solid red";
        else
          document.getElementById("id").style.border = "1px solid black";


         if(userName == "")
        document.getElementById("userName").style.border = "2px solid red";
        else
          document.getElementById("userName").style.border = "1px solid black";


         if(password == "")
        document.getElementById("password").style.border = "2px solid red";
        else
          document.getElementById("password").style.border = "1px solid black";

        if(confirmpass == "")
        document.getElementById("confirmpass").style.border = "2px solid red";
        else
          document.getElementById("confirmpass").style.border = "1px solid black";
               
      }
      else {
        isValid = true;
      }

      return isValid;
    }
    </script>
    </body>
</html>