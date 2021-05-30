<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Shop Update/Delete</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

    <div class="header">
      <?php include 'header.php';?>
    </div>

    <div class="bg">

      <br>
      <h1>Shop Update/Delete</h1>

    <?php
      $srcSErr = $nameErr = $addressErr = $emailErr = $idErr = $userNameErr = $passwordErr = $conPasswordErr = "";

      $srcS = "";
      $name = ""; 
      $address = "";
      $email = "";
      $id = "";
      $userName= "";
      $password= "";
      $conPassword = "";

      $flag = 0;
      $searchKey = "";

      if(isset($_POST['src'])){
        if($_SERVER["REQUEST_METHOD"] == "POST"){

          if(empty($_POST['srcS'])) {
            $srcSErr = "Please fill up the Shop username";
          }
          else {
            $srcS = $_POST['srcS'];
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
        else {

          $stmt1 = $conn1->prepare("select shopName, shopAddress, id, userName, email, password, confirmpass from shopdata where userName = ? ");
          $stmt1->bind_param("s", $p1);
          $p1 = $srcS;
          $stmt1->execute();
          $res2 = $stmt1->get_result();
          $DBshop = $res2->fetch_assoc();

          $name = $DBshop['shopName'];
          $address = $DBshop['shopAddress'];
          $id = $DBshop['id'];
          $email = $DBshop['email'];
          $userName = $DBshop['userName'];
          $password = $DBshop['password'];
          $conPassword = $DBshop['confirmpass'];
          
          if($userName != "")
            $flag = 1;
        }


          if($flag==0)
            echo $srcS." not found";

        mysqli_close($conn1);
        }

      
      if((isset($_POST['update']))||(isset($_POST['delete'])))
      {

        if($_SERVER["REQUEST_METHOD"] == "POST") {

          if(empty($_POST['id'])) {
            $idErr = "Please fill up the id properly";
          }
          else {
            $id = $_POST['id'];
          }

          if(empty($_POST['name'])) {
            $nameErr = "Please fill up the name properly";
          }
          else {
            $name = $_POST['name'];
          }

          if(empty($_POST['address'])) {
            $addressErr = "Please fill up the address properly";
          }
          else {
            $address = $_POST['address'];
          }

          if(empty($_POST['email'])) {
            $emailErr = "Please enter an email";
          }
          else {
            $email = $_POST['email'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
              { 
                $emailErr = "Invalid email format"; 
              }
          }

          if(empty($_POST['uname'])) {
            $userNameErr = "Please fill up the username properly";
            }
          else {
            $userName = $_POST['uname'];
          }

          if(empty($_POST['password'])) {
            $passwordErr = "Please fill up the password properly";
          }
          else {
            $password = $_POST['password'];
          }

          if(empty($_POST['conPassword'])) {
          $conPasswordErr = "Re enterint password is required";
          }
          else {
            $conPassword = $_POST['conPassword'];
          
               if (!($conPassword == $password))
            { $conPasswordErr = "Password not matched"; }
          }      
        }

        $searchKey = $userName;

        if(isset($_POST['update']) && $password==$conPassword)
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

          else
          {
            $stmt2 = mysqli_prepare($conn2, 'update shopdata set shopName = ?, shopAddress = ?, email = ?, password = ?, confirmpass = ? where userName = ?');

            mysqli_stmt_bind_param($stmt2, 'ssssss', $p2, $p3, $p4, $p5, $p6, $p7);

            $p2 = $name;
            $p3 = $address;
            $p4 = $email;
            $p5 = $password;
            $p6 = $conPassword;
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
          if(mysqli_connect_error()) 
          {
            echo "Database Connection Failed!";
            echo "<br>";
            echo $conn3 -> connect_error;
          }
          else
          {
            $stmt3 = mysqli_prepare($conn3, 'delete from shopdata where userName=?');
            mysqli_stmt_bind_param($stmt3, 's', $p10);
            $p10 = $searchKey;
            mysqli_stmt_execute($stmt3);
          }
          mysqli_close($conn3);

        }
      }
    ?>

    <div class="form">

    <form name="srcForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return srcvalidate()" method="POST">

      <label for="srcS">Search Shop:</label>
      <input type="text" name="srcS" id="srcS" value="<?php echo $srcS;?>" placeholder="search here" style = "width: 75%; display: inline-block;">


      <input type="submit" name="src" value="Search" id="srcBtn">
      <p style="color:red"><?php echo $srcSErr; ?></p>

    </form>
    <p id="srcerrorMsg"></p>
    <br>

    <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">
      <fieldset>
        <legend>Basic Information: </legend>

        <label for="name">Shop Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name;?>">

        <p style="color:red"><?php echo $nameErr; ?></p>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $address ?>">

        <p style="color:red"><?php echo $addressErr; ?></p>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="...@gmail.com" value="<?php echo $email ?>">

        <p style="color:red"><?php echo $emailErr; ?></p>

      </fieldset>
      <br>
     
      <fieldset>

        <legend>Shop Account Information: </legend>

        <label for="id">ID:</label>
        <input type="text" name="id" id="id" value="<?php echo $id;?>">

        <p style="color:red"><?php echo $idErr; ?></p>

        <label for="uname">UserName:</label>
        <input type="text" name="uname" id="uname" value="<?php echo $userName; ?>">

        <p style="color:red"><?php echo $userNameErr; ?></p>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>">

        <p style="color:red"><?php echo $passwordErr; ?></p>
        
        <label for="conPassword">Re-type Password:</label>
        <input type="password" name="conPassword" id="conPassword" value="<?php echo $conPassword ?>">

        <p style="color:red"><?php echo $conPasswordErr; ?></p>

      </fieldset>
      <br>
      
      <input type="submit" name="update" value="Update" id="updateBtn">
      <input type="submit" name="delete" value="Delete" id="deleteBtn">

      </form>
      <p id="errorMsg"></p>
    </div>
      <br>
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

      <script>
          function srcvalidate() {
          var isValid = false;
          var srcS = document.forms["srcForm"]["srcS"].value;
        
      if(srcS == "") 

      {
        document.getElementById("srcerrorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("srcerrorMsg").style.color = "red";

        if(srcS == "")
          document.getElementById("srcS").style.border = "2px solid red";
        else
          document.getElementById("srcS").style.border = "1px solid black";
               
      }
      else {
        isValid = true;
      }

      return isValid;
    }

    </script>


     <script>
        function validate() {
          var isValid = false;

          var name = document.forms["jsForm"]["name"].value;
          var address = document.forms["jsForm"]["address"].value;
          var email = document.forms["jsForm"]["email"].value;
          var username = document.forms["jsForm"]["uname"].value;
          var password = document.forms["jsForm"]["password"].value;
          var repassword = document.forms["jsForm"]["conPassword"].value;
          var id = document.forms["jsForm"]["id"].value;

          if(name == "" || address == "" || email == "" || email == "" || username == "" || password == "" || repassword == ""|| id == "") 
          {
            document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
            document.getElementById("errorMsg").style.color = "red";

            if(name == "")
              document.getElementById("name").style.border = "2px solid red";
            else
              document.getElementById("name").style.border = "1px solid black";

            if(address == "")
            document.getElementById("address").style.border = "2px solid red";
            else
              document.getElementById("address").style.border = "1px solid black";

            if(email == "")
              document.getElementById("email").style.border = "2px solid red";
            else
              document.getElementById("email").style.border = "1px solid black";

            if(username == "")
            document.getElementById("uname").style.border = "2px solid red";
            else
              document.getElementById("uname").style.border = "1px solid black";

            if(password == "")
              document.getElementById("password").style.border = "2px solid red";
            else
              document.getElementById("password").style.border = "1px solid black";

            if(repassword == "")
            document.getElementById("conPassword").style.border = "2px solid red";
            else
              document.getElementById("conPassword").style.border = "1px solid black";

          if(id == "")
            document.getElementById("id").style.border = "2px solid red";
            else
              document.getElementById("id").style.border = "1px solid black";
          }
          else {
            isValid = true;
          }

          return isValid;
        }
      </script>


      















    </body>
</html>