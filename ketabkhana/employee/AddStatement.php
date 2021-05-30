<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add In Statements</title>
     <link rel="stylesheet" type="text/css" href="../style.css">

  </head>

  <body>

  <div class="header">
      <?php include 'header.php';?>
  </div>


  <div class="bg">
  		

	    <br>



	    <?php
	      $dateErr = $expenditureErr = $amountErr = "" ;

	      

	      $date= "";
	      $expenditure= "";
	      $amount= "";


	if($_SERVER["REQUEST_METHOD"] == "POST") {


	        if(empty($_POST['date'])) {
	          $dateErr = "Please fill up the date properly";
	          }


	        else {
	          $date = $_POST['date'];
	        }
            

            if(empty($_POST['expenditure'])) {
                $expenditureErr = "Please fill up the expenditure properly";
                }


              else {
                $expenditure = $_POST['expenditure'];
              }


	        if(empty($_POST['amount'])) {
	          $amountErr = "Please fill up the amount properly";
	          }


	        else {
	          $amount = $_POST['amount'];
	        }

	     }

	?>


	 <div class="form" style="margin: 10vh auto;">
	 	<h1> Add in Statement </h1>

	    <form name="jsForm" onsubmit="submitForm(event)">
	     


	        <label for="date">Date:</label>
	        
	        <input type="date" name="date" id="date" value="<?php echo $date; ?>">

	 
	        
	        <p style="color:red"><?php echo $dateErr; ?></p>




	        <label for="expenditure">Expenditure:</label>

	        <input type="text" name="expenditure" id="expenditure" value="<?php echo $expenditure; ?>">

	       
	        <p style="color:red"><?php echo $expenditureErr; ?></p>

	        
	        
	        <label for="amount">Ammount:</label>

	        <input type="number" name="amount" id="amount" placeholder="put (-) for expenses" value="<?php echo $amount ?>" >

	    

	        <p style="color:red"><?php echo $amountErr; ?></p>



			<br>




			<input type="submit" value="Update" id="submit">

            <br>
            <br>
            <br>
            <a href="../employee/ShowStatement.php" title="" class="anchor">Show Full Statement </a>

			</form>

			<p id="errorMsg"></p>

		</div>

			<br>



			<?php



			if( $date!= "" && $expenditure != "" && $amount != "")
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


				$stmt = $conn->prepare("insert into statement (date, expenditure, amount) VALUES (?, ?, ?)");
					$stmt->bind_param("sss", $p1, $p2, $p3);
					$p1 = $date;
					$p2 = $expenditure;
					$p3 = $amount;
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



			var date = document.forms["jsForm"]["date"].value;
			var expenditure = document.forms["jsForm"]["expenditure"].value;
			var amount = document.forms["jsForm"]["amount"].value;

			if(date == "" || expenditure == "" || amount =="") {
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";

				if(date == "")
					document.getElementById("date").style.border = "2px solid red";
				else
					document.getElementById("date").style.border = "1px solid black";

				if(expenditure == "")
				document.getElementById("expenditure").style.border = "2px solid red";
				else
					document.getElementById("expenditure").style.border = "1px solid black";

				if(amount == "")
					document.getElementById("amount").style.border = "2px solid red";
				else
					document.getElementById("amount").style.border = "1px solid black";
				
			}
			else {
				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("errorMsg").innerHTML = "<b>Statement Added Successfully</b>";
	                document.getElementById("errorMsg").style.color = "green";

	                document.getElementById("date").style.border = "1px solid black";
	                document.getElementById("expenditure").style.border = "1px solid black";
	                document.getElementById("amount").style.border = "1px solid black";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("date="+date+"&expenditure="+expenditure+"&amount="+amount);
			}

		
		}
	</script>



    </body>
</html>