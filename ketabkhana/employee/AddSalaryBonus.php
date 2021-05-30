<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">

    <title>Send Salary and Festival Bonus for Approval</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    
  </head>

  <body>



  <div class="header">
      <?php include 'header.php';?>
  </div>

 <div class = "bg">

  	<br>
	


	    <?php
	      $userNameErr = $salaryErr = $bonusErr = "" ;

	      
	      $userName= "";
	      $salary= "";
	      $bonus= "";



	      if($_SERVER["REQUEST_METHOD"] == "POST") {

	        if(empty($_POST['userName'])) {
	          $userNameErr = "Please fill up the username properly";
	          }


	        else {
	          $userName = $_POST['userName'];
	        }
            


            if(empty($_POST['salary'])) {
                $salaryErr = "Please fill up the salary properly";
                }


              else {
                $salary = $_POST['salary'];
              }




	        if(empty($_POST['bonus'])) {
	          $bonusErr = "Please fill up the festival bonus properly";
	          }
	        else {
	          $bonus = $_POST['bonus'];
	        }


	     }   
	    ?>



	    <div class="form" style="margin: 10vh auto;">

	    	<h1>Send Salary and Festival Bonus for Approval </h1>
	    <form name="jsForm" onsubmit="submitForm(event)">
	     
	     


	        <label for="userName">UserName:</label>

	        <input type="text" name="userName" id="userName" value="<?php echo $userName; ?>">
	    

	        <p style="color:red"><?php echo $userNameErr; ?></p>

	        <label for="salary">Salary:</label>

	        <input type="number" name="salary" id="salary" value="<?php echo $salary; ?>">
	   

	        <p style="color:red"><?php echo $salaryErr; ?></p>
	        

	        <label for="bonus">Festival Bonus:</label>

	        <input type="number" name="bonus" id="bonus" value="<?php echo $bonus ?>">
	    

	        <p style="color:red"><?php echo $bonusErr; ?></p>


			<br>


			<input type="submit" value="Send" id="submit">
            <br>
            <br>
            <a href="../employee/ShowSalaryBonus.php" title="" class="anchor">See all employee's salary and festival bonus</a>

       
            
			</form>
				<p id="errorMsg"></p>
			</div>

			<br>

			<?php




			if( $userName != "" && $salary != "" && $bonus != "")
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


				$stmt = $conn->prepare("insert into approval (userName, salary, bonus) VALUES (?, ?, ?)");
					$stmt->bind_param("sss", $p1, $p2, $p3);
					$p1 = $userName;
					$p2 = $salary;
					$p3 = $bonus;
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
			function submitForm(e){
	          	console.log(e);
				e.preventDefault();
				console.log("form submitted");


			var userName = document.forms["jsForm"]["userName"].value;
			var salary = document.forms["jsForm"]["salary"].value;
			var bonus = document.forms["jsForm"]["bonus"].value;

			if(userName == "" || salary == "" || bonus =="") {
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";

				if(userName == "")
					document.getElementById("userName").style.border = "2px solid red";
				else
					document.getElementById("userName").style.border = "1px solid black";

				if(salary == "")
				document.getElementById("salary").style.border = "2px solid red";
				else
					document.getElementById("salary").style.border = "1px solid black";

				if(bonus == "")
					document.getElementById("bonus").style.border = "2px solid red";
				else
					document.getElementById("bonus").style.border = "1px solid black";
				
			}
			else {
				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("errorMsg").innerHTML = "<b>Salary Added Successfully</b>";
	                document.getElementById("errorMsg").style.color = "green";

	                document.getElementById("userName").style.border = "1px solid black";
	                document.getElementById("salary").style.border = "1px solid black";
	                document.getElementById("bonus").style.border = "1px solid black";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("userName="+userName+"&salary="+salary+"&bonus="+bonus);
			}

			
		}
	</script>


    </body>
</html>