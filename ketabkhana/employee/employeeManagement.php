<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profile Update/Delete</title>
     <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>
    
    <div class="header">
      <?php include '../employee/header.php';?>
  </div>

    <div class="bg">

  <br>

      <?php
      
        $firstNameErr = $lastNameErr = $genderErr = $dobErr =  $emailErr = $userNameErr = $passwordErr = $conPasswordErr = "" ;


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

          $stmt1 = $conn1->prepare("select firstName, lastName, gender, dob, email, id, userName, password, conPassword from employee where userName = ? ");
          $stmt1->bind_param("s", $p1);
          $p1 = $searchKey;
          $stmt1->execute();
          $res2 = $stmt1->get_result();
          $DBemployee = $res2->fetch_assoc();

          $firstName = $DBemployee['firstName'];
          $lastName = $DBemployee['lastName'];
          $gender = $DBemployee['gender'];
          $dob = $DBemployee['dob'];
          $email = $DBemployee['email'];
          $id = $DBemployee['id'];
          $userName = $DBemployee['userName'];
          $password = $DBemployee['password'];
          $conPassword = $DBemployee['conPassword'];
     
        }


        if((isset($_POST['update']))||(isset($_POST['delete'])))
        {

            if($_SERVER["REQUEST_METHOD"] == "POST") {

            
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

       

        if(isset($_POST['update']) && $password== $conPassword)
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

          header("location:../logout.php");

        }

        }
        
      ?>


        <div class="form">

          <h1>Profile Update/Delete</h1>

      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">
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
          <p style="color:red"><?php echo $genderErr; ?></p>

          <label for="dob">Date of Birth:</label>
          <input type="date" name="dob" id="dob" value="<?php echo $dob ?>">
          <p style="color:red"><?php echo $dobErr; ?></p>


          <label for="email">Email:</label>
          <input type="email" name="email" id="email" placeholder="...@gmail.com" value="<?php echo $email ?>">

          <p style="color:red"><?php echo $emailErr; ?></p>

        </fieldset>
        <br>
       
        <fieldset >

          <legend>Employee Account Information: </legend>

          <label for="id">ID:</label>
          <input type="text" name="id" id="id" value="<?php echo $id;?>" disabled>
         <br>


          <label for="uname">UserName:</label>
          <input type="text" name="uname" id="uname" value="<?php echo $userName; ?>" disabled>
          <br>


          <label for="pass">Password:</label>
          <input type="password" minlength='4' name="password" id="password" value="<?php echo $password; ?>">

          <p style="color:red"><?php echo $passwordErr; ?></p>

          <label for="conPassword">Re-type Password:</label>
          <input type="password" minlength='4' name="conPassword" id="conPassword" value="<?php echo $conPassword ?>">
      
          <p style="color:red"><?php echo $conPasswordErr; ?></p>

      </fieldset>
      <br>

      <input type="submit" name="update" value="Update"  id="updateBtn">
      <input type="submit" name="delete" value="Delete"  id="deleteBtn">

      </form>

        <p id="errorMsg"></p>
    
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
            text-align: left;
          }
    
         
      </style>


       <script>
          function validate() {
          var isValid = false;
          var fname = document.forms["jsForm"]["fname"].value;
          var lname = document.forms["jsForm"]["lname"].value;
          var gender = document.forms["jsForm"]["gender"].value;
          var dob = document.forms["jsForm"]["dob"].value;
          var email = document.forms["jsForm"]["email"].value;
          var id = document.forms["jsForm"]["id"].value;
          var password = document.forms["jsForm"]["password"].value;
          var conPassword = document.forms["jsForm"]["conPassword"].value;


      if(fname == "" ||lname == "" || gender == "" || dob== ""|| email== "" || id== ""|| password== "" || conPassword == "") 

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
        document.getElementById("gender").style.border = "2px solid red";
        else
          document.getElementById("gender").style.border = "1px solid black";


         if(dob == "")
        document.getElementById("dob").style.border = "2px solid red";
        else
          document.getElementById("dob").style.border = "1px solid black";


         if(email == "")
        document.getElementById("email").style.border = "2px solid red";
        else
          document.getElementById("email").style.border = "1px solid black";


         if(id == "")
        document.getElementById("id").style.border = "2px solid red";
        else
          document.getElementById("id").style.border = "1px solid black";


         if(password == "")
        document.getElementById("password").style.border = "2px solid red";
        else
          document.getElementById("password").style.border = "1px solid black";


        if(conPassword == "")
        document.getElementById("conPassword").style.border = "2px solid red";
        else
          document.getElementById("conPassword").style.border = "1px solid black";
               
      }
      else {
        isValid = true;
      }

      return isValid;
    }

    </script>


    </body>
</html>