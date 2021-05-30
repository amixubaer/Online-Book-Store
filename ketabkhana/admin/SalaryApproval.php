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
		<h1>Salary & Bonus Approval</h1>
		<br>

		<?php

      $Id = "";
			$idErr = "" ;

      $id = "";
      $userName = "";
      $salary = "";
      $bonus = "";
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

            $stmt1 = $conn1->prepare("select id, userName, salary, bonus from approval where id = ?");
            $stmt1->bind_param("i", $p1);
            $p1 = $Id;
            $stmt1->execute();
            $res1 = $stmt1->get_result();
            $DBsalary = $res1->fetch_assoc();

            
            $id = $DBsalary['id'];
            $userName = $DBsalary['userName'];
            $salary = $DBsalary['salary'];
            $bonus = $DBsalary['bonus'];

            
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
      				
      				$stmt2 = $conn2->prepare("insert into salary (userName, salary, bonus) VALUES (?, ?, ?)");
      				$stmt2->bind_param("sss", $p2, $p3, $p4);
      				
      				$p2 = $userName;
      				$p3 = $salary;
      				$p4 = $bonus;
      				
      				
      				$status2 = $stmt2->execute();


      				if($status2) 
              {
      				}
      				else {
      					echo "Failed to Insert Data.";
      					echo "<br>";
      					echo $conn2->error;
      				}

      				$stmt3 = $conn2->prepare("delete from approval where id = ?");
      				$stmt3->bind_param("i", $p5);

      				$p5 = $id;
      					
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
            $stmt4 = $conn4->prepare("delete from approval where id = ?");
              $stmt4->bind_param("i", $p5);

              $p5 = $Id;
                
              $status4 = $stmt4->execute();
          }
          mysqli_close($conn4);

        }
      }
		?>
		

		<div class="form">

      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

      <label for="uid">ID:</label>
      <input type="text" name="uid" id="uid" placeholder="write employee id" value="<?php echo $Id;?>" style = "width: 61%; display: inline-block;">
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
                      <th>Salary</th>
                      <th>Bonus</th>
                    </tr>';

            $stmt2 = "select * from approval";
            $result = $conn2->query($stmt2);

            if ($result->num_rows >= 0)
            {
              while($row = $result->fetch_assoc())     
              {
                echo "<tr>";


                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['userName'] . "</td>";

                echo "<td>" . $row['salary'] . "</td>";

                echo "<td>" . $row['bonus'] . "</td>";


                echo "</tr>";

              }

              echo "</table>";
              echo "<br>";
            }
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


		<script>
    function validate() {
      var isValid = false;
      var addcart = document.forms["jsForm"]["uid"].value;

      if(addcart == "") {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";

        if(addcart == "")
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