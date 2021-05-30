<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Approval</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
 </head>

	<body>
	 
	 	<div class="header">
			<?php include 'header.php';?>
	  	</div>

		<div class="bg">
		<br>
		<h1>Refund Request</h1>
		<br>

		<?php

      $Id = "";
			$idErr = "" ;

      $id = "";
      $userUName = "";
      $shopUName = "";
      $bookId = "";
      $bankInfo = "";
      $amount = "";

      $flag = 0; 
      $f = 0;

      if((isset($_POST['approval'])) || (isset($_POST['delete'])))
      {
        if($_SERVER["REQUEST_METHOD"] == "POST"){

          if(empty($_POST['uid'])) {
            $idErr = "Please fill a valid ID";
          }
          else {
            $Id = $_POST['uid'];
            $f = 1;
          }

        }
		    
		    if(isset($_POST['approval']))
        {
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
          else 
          {

            $stmt1 = $conn1->prepare("select id, userUName, shopUName, bookId, bankInfo, amount from refund where id = ?");
            $stmt1->bind_param("i", $p1);
            $p1 = $Id;
            $stmt1->execute();
            $res1 = $stmt1->get_result();
            $DBrefund = $res1->fetch_assoc();

            
            $id = $DBrefund['id'];
            $userUName = $DBrefund['userUName'];
            $shopUName = $DBrefund['shopUName'];
            $bookId = $DBrefund['bookId'];
            $bankInfo = $DBrefund['bankInfo'];
            $amount = $DBrefund['amount'];

            
            if($id != "")
              $flag = 1;
          }

          if($flag==0)
            echo $Id ." not found";

          mysqli_close($conn1);

          if($flag == 1)
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
      				
      				$stmt2 = $conn2->prepare("insert into refundapproved (userUName, shopUName, bookId, bankInfo, amount) VALUES (?, ?, ?, ?, ?)");
      				$stmt2->bind_param("ssiss", $p2, $p3, $p4, $p5, $p6);
      				
      				$p2 = $userUName;
      				$p3 = $shopUName;
      				$p4 = $bookId;
              $p5 = $bankInfo;
              $p6 = $amount;
      				
      				
      				$status2 = $stmt2->execute();


      				if($status2) 
              {
      				}
      				else {
      					echo "Failed to Insert Data.";
      					echo "<br>";
      					echo $conn2->error;
      				}

      				$stmt3 = $conn2->prepare("delete from refund where id = ?");
      				$stmt3->bind_param("i", $p7);

      				$p7 = $id;
      					
      				$status3 = $stmt3->execute();
      			}

      			$conn2->close();

          }

        }
        if(isset($_POST['delete']))
        {

          $host = "localhost";
          $user = "project";
          $pass = "1234";
          $db = "ketabkhana";

          $conn4 = mysqli_connect($host, $user, $pass, $db);
          if(mysqli_connect_error()) {
            echo "Database Connection Failed!";
            echo "<br>";
            echo $conn4 -> connect_error;
          }
          else {
            $stmt4 = $conn4->prepare("delete from refund where id = ?");
              $stmt4->bind_param("i", $p8);

              $p8 = $Id;
                
              $status4 = $stmt4->execute();
          }
          mysqli_close($conn4);

        }
      }
		?>
		

		<div class="form">

      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

      <label for="uid">ID:</label>
      <input type="text" name="uid" id="uid" placeholder="Write Id" value="<?php echo $Id;?>" style = "width: 61%; display: inline-block;">
     
      
       <input type="submit" name="delete" value="Delete" id = "delBtn" style = "width: 19%; display: inline-block;">

       <input type="submit" name="approval" value="Approve" id = "srcBtn"class="srcBmployeeBtn" style = "width: 19%; display: inline-block;"> 
      <p style="color:red"><?php echo $idErr; ?></p>

    </form>
    <p id="errorMsg"></p>
  </div>
  <br>


  	<?php

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

          echo '<table id= "table" >
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Shop Name</th>
                      <th>Book Id</th>
                      <th>Bank Info</th>
                      <th>Amount</th>
                    </tr>';

            $stmt2 = "select * from refund";
            $result = $conn2->query($stmt2);

            if ($result->num_rows >= 0)
            {
              while($row = $result->fetch_assoc())     
              {
                echo "<tr>";


                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['userUName'] . "</td>";

                echo "<td>" . $row['shopUName'] . "</td>";

                echo "<td>" . $row['bookId'] . "</td>";

                echo "<td>" . $row['bankInfo'] . "</td>";

                echo "<td>" . $row['amount'] . "</td>";


                echo "</tr>";

              }

              echo "</table>";
              echo "<br>";
            }
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

				#delBtn{
       display: inline;
        width: 23%;
        float: right;
        text-transform: uppercase;
         background-color: #BB2A2A;
        border-bottom: 5px solid #c86a40;
        border-radius: 5px;
        cursor: pointer;
      }
      }
				
		</style>

<!-- appref is a variable. short form of approved refund-->
		<script>
    function validate() {
      var isValid = false;
      var appref = document.forms["jsForm"]["uid"].value;

      if(appref == "") {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";

        if(appref == "")
          document.getElementById("uid").style.border = "2px solid red";
        else
          document.getElementById("uid").style.border = "1px solid black";
        
      }
      else {
        isValid = true;
      }

      return isValid;
    }
  </script>

	</body>

</html>