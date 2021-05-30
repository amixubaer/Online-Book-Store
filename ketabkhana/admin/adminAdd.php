<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add an Admin</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>
  	<div class="header">
  		<?php include 'header.php';?>
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
	      $userName= "";
	      $password= "";
	      $conPassword = "";
	      

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
	    ?>

	    <div class="form">
	    	<h1>Add an Admin</h1>



	    <form name="jsForm" onsubmit="submitForm(event)">
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
	        <p id = "ge" style="color:red"><?php echo $genderErr; ?></p>

	        <label for="dob">Date of Birth:</label>
	        <input type="date" name="dob" id="dob" value="<?php echo $dob ?>">
	       
	        <p style="color:red"><?php echo $dobErr; ?></p>

	        <label for="email">Email:</label>
	        <input type="email" name="email" id="email" placeholder="...@gmail.com" value="<?php echo $email ?>">
	       
	        <p style="color:red"><?php echo $emailErr; ?></p>

	      </fieldset>
	      <br>
	     
	      <fieldset>

	        <legend>Admin Account Information: </legend>

	        <label for="uname">UserName:</label>
	        <input type="text" name="uname" id="uname" value="<?php echo $userName; ?>">
	        
	        <p style="color:red"><?php echo $userNameErr; ?></p>

	        <label for="pass">Password:</label>
	        <input type="password" minlength='4' name="password" id="password" value="<?php echo $password; ?>">
	        
	        <p style="color:red"><?php echo $passwordErr; ?></p>
	        
	        <label for="conPassword">Re-type Password:</label>
	        <input type="password" minlength='4' name="conPassword" id="conPassword" value="<?php echo $conPassword ?>">
	        
	        <p style="color:red"><?php echo $conPasswordErr; ?></p>

	      </fieldset>
	      <br>
	      
	      <input type="submit" value="Add" class="addAdminBtn" id="submit" >

	      </form>
	       <p id="errorMsg"></p>
	  </div>

	      <br>

		     <?php 

		     if($firstName!="" && $lastName!="" && $gender!="" && $dob!="" && $email!="" && $userName!="" && $password!="" && $conPassword!="" && $password==$conPassword)
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
					
					$stmt = $conn->prepare("insert into admin (firstName, lastName, gender, dob, email, userName, password, conPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssssss", $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8);
					$p1 = $firstName;
					$p2 = $lastName;
					$p3 = $gender;
					$p4 = $dob;
					$p5 = $email;
					$p6 = $userName;
					$p7 = $password;
					$p8 = $conPassword;
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
					background-image: url('../images/bg.jpg');
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

			var fname = document.forms["jsForm"]["fname"].value;
			var lname = document.forms["jsForm"]["lname"].value;
			var gender = document.forms["jsForm"]["gender"].value;
			var dob = document.forms["jsForm"]["dob"].value;
			var email = document.forms["jsForm"]["email"].value;
			var username = document.forms["jsForm"]["uname"].value;
			var password = document.forms["jsForm"]["password"].value;
			var repassword = document.forms["jsForm"]["conPassword"].value;

          if(fname == "" || lname == "" || gender == "" || dob == ""
            || email == "" || username == "" || password == "" || repassword == "") 
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

            
          }
          else {

          	var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200) {
                document.getElementById("errorMsg").innerHTML = "<b>New Admin Added Successfully</b>";
                document.getElementById("errorMsg").style.color = "green";
                if(password!=repassword)
                {
                  document.getElementById("errorMsg").innerHTML = "<b>Password not matched</b>";
                  document.getElementById("errorMsg").style.color = "red";

                }
                if(password.length<4)
                {
                  document.getElementById("errorMsg").innerHTML = "";
                }

                document.getElementById("fname").style.border = "1px solid black";
                document.getElementById("lname").style.border = "1px solid black";
                document.getElementById("dob").style.border = "1px solid black";
                document.getElementById("email").style.border = "1px solid black";
                document.getElementById("uname").style.border = "1px solid black";
                document.getElementById("password").style.border = "1px solid black";
                document.getElementById("conPassword").style.border = "1px solid black";


              }
            }

            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("fname="+fname+"&lname="+lname+"&gender="+gender+"&dob="+dob+"&email="+email+"&uname="+username+"&password="+password+"&conPassword="+repassword);

          }
        }
      </script>
    </body>
</html>