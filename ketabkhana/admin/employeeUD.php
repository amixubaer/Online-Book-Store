<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employee Update/Delete</title>

    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>
    
    <div class="header">
      <?php include 'header.php';?>
  </div>

    <div class="bg">

      <br>
      

      <?php
        $srcAErr = $firstNameErr = $lastNameErr = $genderErr = $dobErr =  $emailErr = $idErr = $userNameErr = $passwordErr = $conPasswordErr = "" ;


      $srcA = "";
      $firstName = ""; 
      $lastName = "";
      $gender = "";
      $dob = "";
      $email = "";
      $id = "";
      $userName= "";
      $password= "";
      $conPassword = "";
      $flag = 0;
      $searchKey = "";

      if(isset($_POST['src'])){
        if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(empty($_POST['srcA'])) {
        $srcAErr = "Please fill up the Employee username";
          }
          else {
            $srcA = $_POST['srcA'];
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

          $stmt1 = $conn1->prepare("select firstName, lastName, gender, dob, email, id, userName, password, conPassword from employee where userName = ? ");
          $stmt1->bind_param("s", $p1);
          $p1 = $srcA;
          $stmt1->execute();
          $res2 = $stmt1->get_result();
          $employee = $res2->fetch_assoc();

          $firstName = $employee['firstName'];
          $lastName = $employee['lastName'];
          $gender = $employee['gender'];
          $dob = $employee['dob'];
          $email = $employee['email'];
          $id = $employee['id'];
          $userName = $employee['userName'];
          $password = $employee['password'];
          $conPassword = $employee['conPassword'];
          
          if($userName != "")
            $flag = 1;
        }


          if($flag==0)
            echo $srcA." not found";

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

            if(empty($_POST['fname'])) {
              $firstNameErr = "Please fill up the first name properly";
            }
            else {
              $firstName = $_POST['fname'];
            }

            if(empty($_POST['lname'])) {
              $lastNameErr = "Please fill up the last name properly";
            }
            else {
              $lastName = $_POST['lname'];
            }

            if(empty($_POST['dob'])) {
              $dobErr = "Please fill up the date of birth properly";
            }
            else {
              $dob = $_POST['dob'];
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
            $conPasswordErr = "Recovery Email is required";
            }
            else {
              $conPassword = $_POST['conPassword'];
            
                 if (!($conPassword == $password)) 
              { $conPasswordErr = "Password not matched"; }
            }

            if (empty($_POST['gender'])) {
                   $genderErr = "Gender is required"; 
            } 

            else { 
              $gender = $_POST['gender']; 
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

          else{
            $stmt2 = mysqli_prepare($conn2, 'update employee set firstName = ?, lastName = ?, gender = ?, dob = ?, email = ?, password = ?, conPassword = ? where userName = ?');
            mysqli_stmt_bind_param($stmt2, 'ssssssss', $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9);
            $p2 = $firstName;
            $p3 = $lastName;
            $p4 = $gender;
            $p5 = $dob;
            $p6 = $email;
            $p7 = $password;
            $p8 = $conPassword;
            $p9 = $searchKey;
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
            $stmt3 = mysqli_prepare($conn3, 'delete from employee where userName=?');
            mysqli_stmt_bind_param($stmt3, 's', $p10);
            $p10 = $searchKey;
            mysqli_stmt_execute($stmt3);
          }
          mysqli_close($conn3);

        }

        }
        
      ?>
      <div class="form">
        <h1>Employee Update/Delete</h1>

      <form name="srcForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return srcvalidate()" method="POST">

        <label for="srcA">Search Employee:</label>
        <input type="search" name="srcA" id="srcA" value="<?php echo $srcA;?>" placeholder="search here" style = "width: 75%; display: inline-block;">

        <input type="submit" name="src" value="Search" id="srcBtn">
        <p style="color:red"><?php echo $srcAErr; ?></p>

      </form>
      <p id="srcerrorMsg"></p>
      <br>


      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()"method="POST">

        <fieldset>
          <legend>Basic Information: </legend>



          <label for="fname">FirstName:</label>
          <input type="text" name="fname" id="fname" value="<?php echo $firstName;?>">
          
          <p style="color:red"><?php echo $firstNameErr; ?></p>

          <label for="lname">LastName:</label>
          <input type="text" name="lname" id="lname" value="<?php echo $lastName ?>">
          
          <p style="color:red"><?php echo $lastNameErr; ?></p>


          <label for="gender">Choose Gender:</label>

          <input type="radio" name="gender" id="gender" style="display: inline-block; width: 15%;"
          <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male 

          <input type="radio" name="gender" id="gender" style="display: inline-block; width: 15%;"
          <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female 

          <input type="radio" name="gender" id="gender" style="display: inline-block; width: 15%;"
          <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
          <p  id = "ge" style="color:red"><?php echo $genderErr; ?></p>

          <label for="dob">Date of Birth:</label>
          <input type="date" name="dob" id="dob" value="<?php echo $dob ?>">
          
          <p style="color:red"><?php echo $dobErr; ?></p>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" placeholder="...@gmail.com" value="<?php echo $email ?>">
        
          <p style="color:red"><?php echo $emailErr; ?></p>

        </fieldset>
        <br>
       
        <fieldset>

          <legend>employee Account Information: </legend>

          <label for="id">ID:</label>
          <input type="text" name="id" id="id" value="<?php echo $id;?>" >
          
          <p style="color:red"><?php echo $idErr; ?></p>

          <label for="uname">UserName:</label>
          <input type="text" name="uname" id="uname" value="<?php echo $userName; ?>" >
          
          <p style="color:red"><?php echo $userNameErr; ?></p>

          <label for="pass">Password:</label>
          <input type="password" name="password" id="password" value="<?php echo $password; ?>">
          <br>
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
          var srcA = document.forms["srcForm"]["srcA"].value;
        
      if(srcA == "") 

      {
        document.getElementById("srcerrorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("srcerrorMsg").style.color = "red";

        if(srcA == "")
          document.getElementById("srcA").style.border = "2px solid red";
        else
          document.getElementById("srcA").style.border = "1px solid black";
               
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

          var fname = document.forms["jsForm"]["fname"].value;
          var lname = document.forms["jsForm"]["lname"].value;
          var gender = document.forms["jsForm"]["gender"].value;
          var dob = document.forms["jsForm"]["dob"].value;
          var email = document.forms["jsForm"]["email"].value;
          var username = document.forms["jsForm"]["uname"].value;
          var password = document.forms["jsForm"]["password"].value;
          var repassword = document.forms["jsForm"]["conPassword"].value;
          var id = document.forms["jsForm"]["id"].value;

          if(fname == "" || lname == "" || gender == "" || dob == ""
            || email == "" || username == "" || password == "" || repassword == ""|| id == "") 
          {
            document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
            document.getElementById("errorMsg").style.color = "red";

            if(fname == "")
              document.getElementById("fname").style.border = "2px solid red";
            else
              document.getElementById("fname").style.border = "1px solid black";

            if(lname == "")
            document.getElementById("lname").style.border = "2px solid red";
            else
              document.getElementById("lname").style.border = "1px solid black";

            if(gender == "")
            {
              document.getElementById("ge").innerHTML = "<b>Gender Required</b>";
              document.getElementById("ge").style.color = "red";
            }
              
            else
            {
              document.getElementById("ge").innerHTML = "";
            }

            if(dob == "")
            document.getElementById("dob").style.border = "2px solid red";
            else
              document.getElementById("dob").style.border = "1px solid black";

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