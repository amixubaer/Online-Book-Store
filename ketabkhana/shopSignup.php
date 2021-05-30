<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Shop Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
      <?php include 'header2.php';?>
  </div>

  <div class="bg">
    <br>
  
  <?php
    $shopNameErr = $shopAddressErr = $userNameErr=  $emailErr = $passwordErr= $confirmpassErr="";

    $shopName = ""; 
    $shopAddress = ""; 
    $userName= "";
    $email = "";
    $password= "";
    $confirmpass= "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      if(empty($_POST['shopName'])) {
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

          
       if(empty($_POST['userName'])) {
        $userNameErr = "Please fill up the username properly";
      }
      else {
        $userName = $_POST['userName'];
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
      if($confirmpass!==$password)
      {
        $confirmpassErr="Password don't match";
      }
    }
  ?>

  <div class="form">

    <h1>Shop Sign Up</h1>

  <form name="jsForm" onsubmit="submitForm(event)">
    
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


       <label for="userName">Username :</label>
       <input type="text" name="userName" id="userName" value="<?php echo $userName; ?>"> 
       <p style="color:red"><?php echo $userNameErr; ?></p>
    

           <label for="password">Password :</label>
       <input type="password" minlength='4' name="password" id="password" value="<?php echo $password; ?>"> 
       <p style="color:red"><?php echo $passwordErr; ?></p>
    

            <label for="confirmpass">Re-Type Password :</label>
            <input type="password" minlength='4' name="confirmpass" id="confirmpass" value="<?php echo $confirmpass; ?>"> 
            <p style="color:red"><?php echo $confirmpassErr; ?></p>
    
    </fieldset>

        <br>

        <center>

          <input type="submit" value="Submit" id = "submit">
          
        </center>
        

        </form>

        <p id="errorMsg"></p>

      </div>
        <br>
 <?php

        if($shopName != "" && $shopAddress != "" && $userName != "" && $email != "" && $password != "" && $confirmpass != "" && $password == $confirmpass)
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
            echo "Database Connection Successful!";
            
            $stmt = $conn->prepare("insert into shopdata (shopName, shopAddress, userName, email, password, confirmpass) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $p1, $p2, $p3, $p4, $p5, $p6);
            $p1 = $shopName;
            $p2 = $shopAddress;
            $p3 = $userName;
            $p4 = $email;
            $p5 = $password;
            $p6 = $confirmpass;

            $status = $stmt->execute();

            if($status) {
              echo "Data Insertion Successful.";
            }
            else {
              echo "Failed to Insert Data.";
              echo "<br>";
              echo $conn->error;
            }
          }

          $conn->close();
      
          
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

      <script>
        function submitForm(e) 
        {

          console.log(e);
          e.preventDefault();
          console.log("form submitted");

          var shopName = document.forms["jsForm"]["shopName"].value;
          var shopAddress = document.forms["jsForm"]["shopAddress"].value;
          var email = document.forms["jsForm"]["email"].value;
          var userName = document.forms["jsForm"]["userName"].value;
          var password = document.forms["jsForm"]["password"].value;
          var confirmpass = document.forms["jsForm"]["confirmpass"].value;


          if(shopName == "" || shopAddress == "" || email == "" || userName == ""
            || password == "" || confirmpass == "") 
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


            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200) {
                document.getElementById("errorMsg").innerHTML = "<b>Shop Added Successfully</b>";
                document.getElementById("errorMsg").style.color = "green";
                if(password!=confirmpass)
                {
                  document.getElementById("errorMsg").innerHTML = "<b>Password not matched</b>";
                  document.getElementById("errorMsg").style.color = "red";

                }
                if(password.length<4)
                {
                  document.getElementById("errorMsg").innerHTML = "";
                }

                document.getElementById("shopName").style.border = "1px solid black";
                document.getElementById("shopAddress").style.border = "1px solid black";
                document.getElementById("email").style.border = "1px solid black";
                document.getElementById("userName").style.border = "1px solid black";
                document.getElementById("password").style.border = "1px solid black";
                document.getElementById("confirmpass").style.border = "1px solid black";
              }
            }

            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("shopName="+shopName+"&shopAddress="+shopAddress+"&email="+email+"&userName="+userName+"&password="+password+"&confirmpass="+confirmpass);

          }

        }
      </script>


    </body>
</html>