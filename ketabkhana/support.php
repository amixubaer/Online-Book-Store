<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

	<div class="header">
		<?php include 'header2.php';?>
	</div>
		<div class="bg">
			

			<br>
			

			<?php
				$nameErr = $numberErr= $emailErr= $subjectErr="";

				$name = ""; 
				$number = ""; 
				$email = "";
				$subject="";


				if($_SERVER["REQUEST_METHOD"] == "POST") {
					if(empty($_POST['name'])) {
						$nameErr = "Please fill up the name properly";
					}
					else {
						$name = $_POST['name'];
					}

					if(empty($_POST['number'])) {
						$numberErr = "Please fill up the mobile number properly";
					}
					else {
						$number = $_POST['number'];
					}

					 if(empty($_POST['email'])) {
						$emailErr = "Email is required";
					}
					else {
						$email = $_POST['email'];
					
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
						{ $emailErr = "Invalid email format"; }
				         }

			        if(empty($_POST['subject'])) {
						$subjectErr = "Please fill up the comments properly";
					}
					else {
						$subject = $_POST['subject'];
					}

				     }

			?>

			<div class="form" style="margin: 10vh auto;">

				<h1>Contact Us</h1>

				<form name="jsForm" onsubmit="submitForm(event)">	

					<label for="name">Name :</label>
					<input type="text" id="name" name="name" value="<?php echo $name; ?>" >
					<p style="color:red"><?php echo $nameErr; ?></p>
			

					<label for="number">Phone number:</label>
					<input name="number" type="text" id="number" value="<?php echo $number; ?>" >
					<p style="color:red"><?php echo $numberErr; ?></p>


					<label for="email">Email address:</label>
					<input name="email" type="text" id="email"  value="<?php echo $email; ?>" >
					<p style="color:red"><?php echo $emailErr; ?></p>
		 

					<label for="subject">Comments:</label>

					<textarea name="subject" id="subject"  rows="7" cols="20" value="<?php echo $subject; ?>" >
					</textarea>

					<p style="color:red"><?php echo $subjectErr; ?></p>

					<input type="submit" value="Submit" id="submit">

				
				</form>
				<p id="errorMsg"></p>
			</div>

			<br>
			<?php

				if ($name!=""  && $number!="" &&  $email!="" &&  $subject!="")
				{ echo "<b> The form is submitted </b> ";}
			?>
			<?php

			  if ($name!=""  && $number!="" &&  $email!="" &&  $subject!="" && $emailErr == "")
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
			      
			      $stmt = $conn->prepare("insert into support (name, number, email, subject) VALUES (?, ?, ?, ?)");

			      $stmt->bind_param("ssss", $p1, $p2, $p3, $p4);

			      $p1 = $name;
			      $p2 = $number;
			      $p3 = $email;
			      $p4 = $subject;

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
          function submitForm(e){
          	console.log(e);
			e.preventDefault();
			console.log("form submitted");

			var name = document.forms["jsForm"]["name"].value;
			var number = document.forms["jsForm"]["number"].value;
			var email = document.forms["jsForm"]["email"].value;
			var subject = document.forms["jsForm"]["subject"].value;

			if(name == "" || number == "" || email== ""|| subject== "") 

			{
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";


				if(name == "")
					document.getElementById("name").style.border = "2px solid red";
				else
				    document.getElementById("name").style.border = "1px solid black";


				if(number == "")
					document.getElementById("number").style.border = "2px solid red";
				else
				    document.getElementById("number").style.border = "1px solid black";


				if(email == "")
					document.getElementById("email").style.border = "2px solid red";
				else
				    document.getElementById("email").style.border = "1px solid black";


				if(subject == "")
					document.getElementById("subject").style.border = "2px solid red";
				else
				    document.getElementById("subject").style.border = "1px solid black";

			}
			else {

				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("errorMsg").innerHTML = "<b>Message sent Successfully</b>";
	                document.getElementById("errorMsg").style.color = "green";

	                document.getElementById("name").style.border = "1px solid black";
	                document.getElementById("number").style.border = "1px solid black";
	                document.getElementById("email").style.border = "1px solid black";
	                document.getElementById("subject").style.border = "1px solid black";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("name="+name+"&number="+number+"&email="+email+"&subject="+subject);

				
			}
		}

    </script>
	</body>

</html>