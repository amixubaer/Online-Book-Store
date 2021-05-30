<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">

    <title>Refund Request</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    
  </head>

  <body>



  <div class="header">
      <?php include 'header.php';?>
  </div>

 <div class = "bg">

  	<br>
	


	    <?php
	      $userUNameErr = $shopUNameErr = $bookIdErr = $bankInfoErr = $amountErr = "" ;

	      
	      $userUName= "";
	      $shopUName= "";
	      $bookId= "";
	      $bankInfo= "";
	      $amount= "";



	      if($_SERVER["REQUEST_METHOD"] == "POST") {

	        if(empty($_POST['userUName'])) {
	          $userUNameErr = "Please fill up the username properly";
	          }


	        else {
	          $userUName = $_POST['userUName'];
	        }
            


            if(empty($_POST['shopUName'])) {
                $shopUNameErr = "Please fill up the shopname properly";
                }


              else {
                $shopUName = $_POST['shopUName'];
              }




	        if(empty($_POST['bookId'])) {
	          $bookIdErr = "Please fill up the  Book Id properly";
	          }
	        else {
	          $bookId = $_POST['bookId'];
	        }



	        if(empty($_POST['bankInfo'])) {
                $bankInfoErr = "Please fill up the Bank Info properly";
                }


              else {
                $bankInfo = $_POST['bankInfo'];
              }




              if(empty($_POST['amount'])) {
                $shopUNameErr = "Please fill up the amount properly";
                }


              else {
                $amount = $_POST['amount'];
              }


	     }   
	    ?>



	    <div class="form" style="margin: 10vh auto;">

	    	<h1> Request for Refund </h1>
	    <form name="jsForm" onsubmit="submitForm(event)">
	     
	     


	        <label for="userUName">User Name:</label>

	        <input type="text" name="userUName" id="userUName" value="<?php echo $userUName; ?>">
	    

	        <p style="color:red"><?php echo $userUNameErr; ?></p>

	        <label for="shopUName">Shop Name:</label>

	        <input type="text" name="shopUName" id="shopUName" value="<?php echo $shopUName; ?>">
	   

	        <p style="color:red"><?php echo $shopUNameErr; ?></p>
	        

	        <label for="bookId">Book Id:</label>

	        <input type="number" name="bookId" id="bookId" value="<?php echo $bookId ?>">
	    

	        <p style="color:red"><?php echo $bookIdErr; ?></p>


	        <label for="bankInfo">Bank Info:</label>

	        <input type="text" name="bankInfo" id="bankInfo" value="<?php echo $bankInfo ?>">
	    

	        <p style="color:red"><?php echo $bankInfoErr; ?></p>




	        <label for="amount">Amount:</label>

	        <input type="number" name="amount" id="amount" value="<?php echo $amount ?>">
	    

	        <p style="color:red"><?php echo $amountErr; ?></p>


			<br>


			<input type="submit" value="Send" id="submit">
            <br>
            
			</form>
				<p id="errorMsg"></p>
			</div>

			<br>



			<?php
			if( $userUName != "" && $shopUName != "" && $bookId != "" && $bankInfo != "" && $amount != "")
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


				$stmt = $conn->prepare("insert into refund (userUName, shopUName, bookId, bankInfo, amount) VALUES (?, ?, ?, ?, ?)");
					$stmt->bind_param("ssiss", $p1, $p2, $p3, $p4, $p5);
					$p1 = $userUName;
					$p2 = $shopUName;
					$p3 = $bookId;
					$p4 = $bankInfo;
					$p5 = $amount;


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

			var userUName = document.forms["jsForm"]["userUName"].value;
			var shopUName = document.forms["jsForm"]["shopUName"].value;
			var bookId = document.forms["jsForm"]["bookId"].value;
			var bankInfo = document.forms["jsForm"]["bankInfo"].value;
			var amount = document.forms["jsForm"]["amount"].value;



			if(userUName == "" || shopUName == "" || bookId =="" || bankInfo == "" || amount =="") {
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";

				if(userUName == "")
					document.getElementById("userUName").style.border = "2px solid red";
				else
					document.getElementById("userUName").style.border = "1px solid black";

				if(shopUName == "")
				document.getElementById("shopUName").style.border = "2px solid red";
				else
					document.getElementById("shopUName").style.border = "1px solid black";

				if(bookId == "")
					document.getElementById("bookId").style.border = "2px solid red";
				else
					document.getElementById("bookId").style.border = "1px solid black";

				if(bankInfo == "")
					document.getElementById("bankInfo").style.border = "2px solid red";
				else
					document.getElementById("bankInfo").style.border = "1px solid black";


				if(amount == "")
					document.getElementById("amount").style.border = "2px solid red";
				else
					document.getElementById("amount").style.border = "1px solid black";


				
			}
			else {
				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("errorMsg").innerHTML = "<b>Refund Requested Successfully</b>";
	                document.getElementById("errorMsg").style.color = "green";

	                document.getElementById("userUName").style.border = "1px solid black";
	                document.getElementById("shopUName").style.border = "1px solid black";
	                document.getElementById("bookId").style.border = "1px solid black";
	                document.getElementById("bankInfo").style.border = "1px solid black";
	                document.getElementById("amount").style.border = "1px solid black";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("userUName="+userUName+"&shopUName="+shopUName+"&bookId="+bookId+"&bankInfo="+bankInfo+"&amount="+amount);
			}

		
		}
	</script>


    </body>
</html>