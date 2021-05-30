<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Payment Option</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

    <div class="header">
      <?php include 'header.php';?>
      </div>

    <div class="bg">

      <br>

    <?php
        $firstNameErr = $lastNameErr = $addressErr = $cityErr = $stateErr = $postalErr = $dateErr = $paymentErr = $productErr = "" ;

      $firstName = ""; 
      $lastName = "";
      $address = "";
      $city = "";
      $state = "";
      $postal= "";
      $date= "";
      $payment = "";
      $product = "";

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


        if(empty($_POST['address'])) {
          $addressErr = "Please fill up street address";
          }
        else {
          $address = $_POST['address'];
        }


        if(empty($_POST['city'])) {
          $cityErr = "Please fill up the city name";
          }
        else {
          $city = $_POST['city'];
        }


        if(empty($_POST['state'])) {
          $stateErr = "Please fill up the state name";
          }
        else {
          $state = $_POST['state'];
        }


        if(empty($_POST['postal'])) {
          $postalErr = "Please fill up the postal code";
          }
        else {
          $postal = $_POST['postal'];
        }


        if(empty($_POST['date'])) {
          $dateErr = "Please fill up the date properly";
        }
        else {
          $date = $_POST['date'];
        }

        
        if(empty($_POST['payment'])) {
          $paymentErr = "Please fill up the payment Option";
        }
        else {
          $payment = $_POST['payment'];
        }


        if(empty($_POST['product'])) {
          $productErr = "Please check the products";
        }
        else {
          $product = $_POST['product'];
        }


      }

    ?>
    <div class = "form">

       <h1>Payment Receipt</h1>

    <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

        <label for="name"><b>Name: </b></label>
  

        <input type="text" placeholder="First Name" name="fname" id="fname" value="<?php echo $firstName;?>">
 
        <p style="color:red"><?php echo $firstNameErr; ?></p>

        <input type="text" placeholder="Last Name" name="lname" id="lname" value="<?php echo $lastName ?>">

        <p style="color:red"><?php echo $lastNameErr; ?></p>
        

        <label for="add"><b>Address: </b></label>


        <input type="text" placeholder="Street Address" name="address" id="address" value="<?php echo $address ?>">

        <p style="color:red"><?php echo $addressErr; ?></p>

        <input type="text" placeholder="City" name="city" id="city" value="<?php echo $city ?>">

        <p style="color:red"><?php echo $cityErr; ?></p>

        <input type="text" placeholder="State/Province" name="state" id="state" value="<?php echo $state ?>">

        <p style="color:red"><?php echo $stateErr; ?></p>

        <input type="text" placeholder="Postal/Zip Code" name="postal" id="postal" value="<?php echo $postal ?>">

        <p style="color:red"><?php echo $postalErr; ?></p>


        <label for="date"><b>Date: </b></label>


        <input type="date" name="date" id="date" value="<?php echo $date ?>">

        <p style="color:red"><?php echo $dateErr; ?></p>
        
    
        <label for="payment"><b>Payment Method: </b></label>
        <br>

        <input type="radio" name="payment" id = "payment" style="display: inline-block; width: 15%;"
        <?php if (isset($payment) && $payment=="card") echo "checked";?>value="card">Card
 

        <input type="radio" name="payment" id = "payment" style="display: inline-block; width: 15%;"
        <?php if (isset($payment) && $payment=="check") echo "checked";?> value="check">Check 


        <input type="radio" name="payment" id = "payment" style="display: inline-block; width: 15%;"
        <?php if (isset($payment) && $payment=="cash") echo "checked";?> value="cash">Cash
 
        <p id="py" style="color:red"><?php echo $paymentErr; ?></p>
        

        <label for="product"><b>My Product: </b></label>
        <br>

        <input type="checkbox" name="product" id="product" style="display: inline-block; width: 30%;"
        <?php if (isset($product) && $product=="a game of thrones") echo "checked";?> value="a game of thrones">A Game of Thrones TK.1800.00


        <input type="checkbox" name="product" id="product" style="display: inline-block; width: 30%;"
        <?php if (isset($product) && $product=="harry potter") echo "checked";?> value="harry potter">Harry Potter TK.2100.00 

        <input type="checkbox" name="product" id="product" style="display: inline-block; width: 30%;"
        <?php if (isset($product) && $product=="meghpion") echo "checked";?> value="meghpion">MeghPion TK.468.00
        <br>
        <p id="pr" style="color:red"><?php echo $productErr; ?></p>     
        
        <p><b>Total: TK.4368.00</b></p>

      <input type="submit" value="Submit" id="submit">

      </form>
      <p id="errorMsg"></p>
    </div>
      <br>

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

      #sumbit{
        padding: 10px 50px
      }
 

    </style>

    <script>
    function validate() {
      var isValid = false;
      var fname = document.forms["jsForm"]["fname"].value;
      var lname = document.forms["jsForm"]["lname"].value;
      var address = document.forms["jsForm"]["address"].value;
      var city = document.forms["jsForm"]["city"].value;
      var state = document.forms["jsForm"]["state"].value;
      var pcode = document.forms["jsForm"]["postal"].value;
      var date = document.forms["jsForm"]["date"].value;
      var payment = document.forms["jsForm"]["payment"].value;


      if(fname == "" || lname == "" || address == "" || city == "" || state == "" || pcode == "" || date == "" || payment == "")
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

        if(address == "")
        document.getElementById("address").style.border = "2px solid red";
        else
          document.getElementById("address").style.border = "1px solid black";

        if(city == "")
        document.getElementById("city").style.border = "2px solid red";
        else
          document.getElementById("city").style.border = "1px solid black";

        if(state == "")
        document.getElementById("state").style.border = "2px solid red";
        else
          document.getElementById("state").style.border = "1px solid black";

        if(pcode == "")
        document.getElementById("postal").style.border = "2px solid red";
        else
          document.getElementById("postal").style.border = "1px solid black";

        if(date == "")
        document.getElementById("date").style.border = "2px solid red";
        else
          document.getElementById("date").style.border = "1px solid black";

        if(payment == "")
        {
              document.getElementById("py").innerHTML = "<b>Method Required</b>";
              document.getElementById("py").style.color = "red";
            }
              
            else
            {
              document.getElementById("py").innerHTML = "";
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