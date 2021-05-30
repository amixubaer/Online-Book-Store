<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add Book </title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>
     <div class="header">
      <?php include 'header.php';?>
  </div>

    <div class="bg">
 
     <br>

    <?php
      $thumbnailErr =  $idErr = $booktitleErr = $bookauthorErr = $bookpublisherErr = $bookeditionErr = $bookpriceErr ="";

      $thumbnail = "";
      $booktitle = ""; 
      $bookauthor = "";
      $bookpublisher = "";
      $bookedition= "";
      $bookprice= "";
      $sUname = $_SESSION['userNameV'];


      if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST['thumbnail'])) {
          $thumbnailErr = "Please fill up book thumbnail properly";
        }
        else {
          $thumbnail = $_POST['thumbnail'];
        }

        if(empty($_POST['booktitle'])) {
          $booktitleErr = "Please fill up book title properly";
        }
        else {
          $booktitle = $_POST['booktitle'];
        }

        if(empty($_POST['bookauthor'])) {
          $bookauthorErr = "Please fill up the book author properly";
        }
        else {
          $bookauthor = $_POST['bookauthor'];
        }

        if(empty($_POST['bookpublisher'])) {
          $bookpublisherErr = "Please fill up the book publisher properly";
        }
        else {
          $bookpublisher = $_POST['bookpublisher'];
        }

        if(empty($_POST['bookedition'])) {
          $bookeditionErr = "Please fill up the book edition properly";
          }
        else {
          $bookedition = $_POST['bookedition'];
        }

        if(empty($_POST['bookprice'])) {
          $bookpriceErr = "Please fill up the book price properly";
          }
        else {
          $bookprice = $_POST['bookprice'];
        }
        
      }

    ?>
       <div class="form" style="margin: 5vh auto;">

        <h1>Add Book</h1>

    <form name="jsForm" onsubmit="submitForm(event)">

        <label for="thumbnail">Book Thumbnail:</label>
        <input type="text" name="thumbnail" id="thumbnail" value="<?php echo $thumbnail;?>">
       
        <p style="color:red"><?php echo $thumbnailErr; ?></p>

        <label for="booktitle">Book Title:</label>
        <input type="text" name="booktitle" id="booktitle" value="<?php echo $booktitle;?>">
      
        <p style="color:red"><?php echo $booktitleErr; ?></p>

        <label for="bookauthor">Book Author:</label>
        <input type="text" name="bookauthor" id="bookauthor" value="<?php echo $bookauthor ?>">
       
        <p style="color:red"><?php echo $bookauthorErr; ?></p>

        <label for="bookpublisher">Book Publisher:</label>
        <input type="text" name="bookpublisher" id="bookpublisher" value="<?php echo $bookpublisher ?>">
      
        <p style="color:red"><?php echo $bookpublisherErr; ?></p>

        <label for="bookedition">Book Edition:</label>
        <input type="text" name="bookedition" id="bookedition" value="<?php echo $bookedition ?>">
   
        <p style="color:red"><?php echo $bookeditionErr; ?></p>

        <label for="bookprice">Book Price:</label>
        <input type="text" name="bookprice" id="bookprice" value="<?php echo $bookprice ?>">
     
        <p style="color:red"><?php echo $bookpriceErr; ?></p>

      <br>
      
      <input type="submit" value="Add" class="addBookBtn" id="submit">
      
      </form>
      <p id="errorMsg"></p>
    </div>

        <br>

      <?php

      if($thumbnail != "" && $booktitle != "" && $bookauthor != "" && $bookpublisher != "" && $bookedition != "" && $bookprice != "")
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
          
          $stmt = $conn->prepare("insert into bookdata (thumbnail, booktitle, bookauthor, bookpublisher, bookedition, bookprice, suname) VALUES (?, ?, ?, ?, ?, ?,?)");
          $stmt->bind_param("sssssss", $p1, $p2, $p3, $p4, $p5, $p6,$p7);
          $p1 = $thumbnail;
          $p2 = $booktitle;
          $p3 = $bookauthor;
          $p4 = $bookpublisher;
          $p5 = $bookedition;
          $p6 = $bookprice;
          $p7 = $sUname;


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
          
            var thumbnail = document.forms["jsForm"]["thumbnail"].value;
            var booktitle = document.forms["jsForm"]["booktitle"].value;
            var bookauthor = document.forms["jsForm"]["bookauthor"].value;
            var bookpublisher = document.forms["jsForm"]["bookpublisher"].value;
            var bookedition = document.forms["jsForm"]["bookedition"].value;
            var bookprice = document.forms["jsForm"]["bookprice"].value;

          if(thumbnail == "" || booktitle == "" || bookauthor== ""|| bookpublisher== "" || bookedition== ""|| bookprice== "") 

          {
            document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
            document.getElementById("errorMsg").style.color = "red";


            if(thumbnail == "")
              document.getElementById("thumbnail").style.border = "2px solid red";
            else
              document.getElementById("thumbnail").style.border = "1px solid black";


            if(booktitle == "")
            document.getElementById("booktitle").style.border = "2px solid red";
            else
              document.getElementById("booktitle").style.border = "1px solid black";


             if(bookauthor == "")
            document.getElementById("bookauthor").style.border = "2px solid red";
            else
              document.getElementById("bookauthor").style.border = "1px solid black";


             if(bookpublisher == "")
            document.getElementById("bookpublisher").style.border = "2px solid red";
            else
              document.getElementById("bookpublisher").style.border = "1px solid black";


             if(bookedition == "")
            document.getElementById("bookedition").style.border = "2px solid red";
            else
              document.getElementById("bookedition").style.border = "1px solid black";


             if(bookprice == "")
            document.getElementById("bookprice").style.border = "2px solid red";
            else
              document.getElementById("bookprice").style.border = "1px solid black";
                   
          }
          else {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200) {
                document.getElementById("errorMsg").innerHTML = "<b>Book Added Successfully</b>";
                document.getElementById("errorMsg").style.color = "green";

                document.getElementById("thumbnail").style.border = "1px solid black";
                document.getElementById("booktitle").style.border = "1px solid black";
                document.getElementById("bookauthor").style.border = "1px solid black";
                document.getElementById("bookpublisher").style.border = "1px solid black";
                document.getElementById("bookedition").style.border = "1px solid black";
                document.getElementById("bookprice").style.border = "1px solid black";

              }
            }

            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("thumbnail="+thumbnail+"&booktitle="+booktitle+"&bookauthor="+bookauthor+"&bookpublisher="+bookpublisher+"&bookedition="+bookedition+"&bookprice="+bookprice);
          
          }
      }
    </script>

    </body>
</html>