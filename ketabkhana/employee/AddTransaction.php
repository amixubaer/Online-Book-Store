<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add In Transaction</title>
     <link rel="stylesheet" type="text/css" href="../style.css">
  </head>

  <body>

  <div class="header">
      <?php include 'header.php';?>
  </div>


  <div class="bg">
  		
  		<br>

	    <?php
	      $productIdErr = $shopproductIdrr = $userproductIdrr = $amountErr = "" ;

	      

	      $productId= "";
	      $shopUName= "";
	      $userUName= "";
	      $amount= "";


	if($_SERVER["REQUEST_METHOD"] == "POST") {


	        if(empty($_POST['productId'])) {
	          $productIdErr = "Please fill up the Product Id properly";
	          }


	        else {
	          $productId = $_POST['productId'];
	        }
            

            if(empty($_POST['shopUName'])) {
                $shopproductIdrr = "Please fill up the Shop Username properly";
                }


              else {
                $shopUName = $_POST['shopUName'];
              }


              if(empty($_POST['userUName'])) {
                $userproductIdrr = "Please fill up the User Username properly";
                }


              else {
                $userUName = $_POST['userUName'];
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

			<h1> Add in Transaction </h1>

	    <form name="jsForm" onsubmit="submitForm(event)">
	     



	        <label for="productId">Product Id:</label>
	        
	        <input type="text" name="productId" id="productId" value="<?php echo $productId; ?>">

	   
	        
	        <p style="color:red"><?php echo $productIdErr; ?></p>


	        <label for="shopUName">Shop Username:</label>

	        <input type="text" name="shopUName" id="shopUName" value="<?php echo $shopUName; ?>">


	        <p style="color:red"><?php echo $shopproductIdrr; ?></p>

	        
	          <label for="userUName">User Username:</label>

	        <input type="text" name="userUName" id="userUName" value="<?php echo $userUName; ?>">



	        <p style="color:red"><?php echo $userproductIdrr; ?></p>


	        <label for="amount">amount:</label>

	        <input type="number" name="amount" id="amount" value="<?php echo $amount ?>" >

	        <br>

	        <p style="color:red"><?php echo $amountErr; ?></p>


			<br>


			<input type="submit" value="Upload" id="submit">

            <br>
            <br>
            <a href="../employee/ShowTransaction.php" title="" class="anchor">Show Full Transaction History</a>

			</form>
			<p id="errorMsg"></p>
		</div>

			<br>



			<?php



			if( $productId!= "" && $shopUName != "" && $userUName != "" && $amount != "")
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


				$stmt = $conn->prepare("insert into transaction (productId, shopUName, userUName, amount) VALUES (?, ?, ?, ?)");
					$stmt->bind_param("isss", $p1, $p2, $p3, $p4);
					$p1 = $productId;
					$p2 = $shopUName;
					$p3 = $userUName;
					$p4 = $amount;
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



			var productId = document.forms["jsForm"]["productId"].value;
			var shopUName = document.forms["jsForm"]["shopUName"].value;
			var userUName = document.forms["jsForm"]["userUName"].value;
			var amount = document.forms["jsForm"]["amount"].value;


			if(productId == "" || shopUName == "" || userUName =="" || amount == "") {
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";

				if(productId == "")
					document.getElementById("productId").style.border = "2px solid red";
				else
					document.getElementById("productId").style.border = "1px solid black";

				if(shopUName == "")
				document.getElementById("shopUName").style.border = "2px solid red";
				else
					document.getElementById("shopUName").style.border = "1px solid black";

				if(userUName == "")
					document.getElementById("userUName").style.border = "2px solid red";
				else
					document.getElementById("userUName").style.border = "1px solid black";


				if(amount == "")
					document.getElementById("amount").style.border = "2px solid red";
				else
					document.getElementById("amount").style.border = "1px solid black";
				
			}
			else {
				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("errorMsg").innerHTML = "<b>Transaction Added Successfully</b>";
	                document.getElementById("errorMsg").style.color = "green";

	                document.getElementById("productId").style.border = "1px solid black";
	                document.getElementById("shopUName").style.border = "1px solid black";
	                document.getElementById("userUName").style.border = "1px solid black";
	                document.getElementById("amount").style.border = "1px solid black";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("productId="+productId+"&shopUName="+shopUName+"&userUName="+userUName+"&amount="+amount);

			}

		}
	</script>



    </body>
</html>