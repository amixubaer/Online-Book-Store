<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">

  </head>
  <body >

  	<div class="header">
        <?php include 'header2.php';?>
    </div>

  	<div class="bg">
      <br>


      <?php
          $typeErr =  "" ;

        $type = "";

    	if($_SERVER["REQUEST_METHOD"] == "POST") {
          
          if (empty($_POST['type'])) {
                 $typeErr = "type is required"; 
          } 

          else { 
            $type = $_POST['type']; 

            if($type == "shop")
            {
              header("Location: shopSignup.php");
            }

            else if($type == "user")
            {
              header("Location: userSignup.php");
            }

          }

      }


      ?>

      <div class="form" style="margin: 10vh auto;">
        <h1>Register as a</h1>
    	<form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" onsubmit="return validate()">
        <fieldset>

          <label for="type">Choose type:</label>

          <input type="radio" name="type" id="type" style="display: inline-block; width: 30%;"
          <?php if (isset($type) && $type=="shop") echo "checked";?> value="shop">Shop 

          <input type="radio" name="type" id="type" style="display: inline-block; width: 30%;"
          <?php if (isset($type) && $type=="user") echo "checked";?> value="user">User 

          <p id = "te" style="color:red"><?php echo $typeErr; ?></p>

        </fieldset>
        <center>

          <input type="submit" value="Submit" id="submit">
          
        </center>
        
        </form>
        
      </div>


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
          function validate() {
          var isValid = false;
          var type = document.forms["jsForm"]["type"].value;

      if(type == "") 

      {

        if(type == "")
            {
              document.getElementById("te").innerHTML = "<b>Type Required</b>";
              document.getElementById("te").style.color = "red";
            }
              
            else
            {
              document.getElementById("te").innerHTML = "";
            }


      }
      else {
        isValid = true;
      }

      return isValid;
    }

    </script>

    </body>
</html>