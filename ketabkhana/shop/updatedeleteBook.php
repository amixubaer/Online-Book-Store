<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Update-Delete Book</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>
  	<div class="header">
      <?php include 'header.php';?>
  </div>
     
    <div class="bg">

      <br>

    <?php
       $srcBErr = $thumbnailErr =  $idErr = $booktitleErr = $bookauthorErr = $bookpublisherErr = $bookeditionErr = $bookpriceErr ="";

      $srcB = "";
      $thumbnail = "";
      $id = "";
      $booktitle = ""; 
      $bookauthor = "";
      $bookpublisher = "";
      $bookedition= "";
      $bookprice= "";
      $flag = 0;
      $searchKey = "";
      $myShop = $_SESSION['userNameV'];

      if(isset($_POST['src'])){
          if($_SERVER["REQUEST_METHOD"] == "POST"){

          if(empty($_POST['srcB'])) {
            $srcBErr = "Please fill up the book userName";
          }
          else {
            $srcB = $_POST['srcB'];
          }
          
         }

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
        else {

          $stmt1 = $conn1->prepare("select thumbnail, id, booktitle, bookauthor, bookpublisher, bookedition, bookprice from bookdata where id = ? and sUname = ?");
          $stmt1->bind_param("ss", $p1, $p2);
          $p1 = $srcB;
          $p2 = $myShop;
          $stmt1->execute();
          $res2 = $stmt1->get_result();
          $DBbook = $res2->fetch_assoc();
        
          $thumbnail = $DBbook['thumbnail'];
          $id = $DBbook['id'];
          $booktitle = $DBbook['booktitle'];
          $bookauthor = $DBbook['bookauthor'];
          $bookpublisher = $DBbook['bookpublisher'];
          $bookedition= $DBbook['bookedition'];
          $bookprice= $DBbook['bookprice'];

          
          if($booktitle != "")
            $flag = 1;
        }


          if($flag==0)
            echo $srcB." not found";

        mysqli_close($conn1);

      }

      if((isset($_POST['update']))||(isset($_POST['delete'])))
        {

       if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST['thumbnail'])) {
          $thumbnailErr = "Please fill up book thumbnail properly";
        }
        else {
          $thumbnail = $_POST['thumbnail'];
        }

         if(empty($_POST['id'])) {
          $idErr = "Please fill up id properly";
        }
        else {
          $id = $_POST['id'];
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

      if(isset($_POST['update']))
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

          else{
            $stmt2 = mysqli_prepare($conn2, 'update bookdata set thumbnail = ?, id = ?, booktitle = ?, bookauthor = ?, bookpublisher = ?, bookedition = ?, bookprice = ? where id = ?');
            mysqli_stmt_bind_param($stmt2, 'sisssssi', $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9);
            $p2 = $thumbnail;
            $p3 = $id;
            $p4 = $booktitle;
            $p5 = $bookauthor;
            $p6 = $bookpublisher;
            $p7 = $bookedition;
            $p8 = $bookprice;
            $p9 = $id;

            mysqli_stmt_execute($stmt2);
          }

          mysqli_close($conn2);

    }

    if(isset($_POST['delete']))
    {

      $host = "localhost";
      $user = "project";
      $pass = "1234";
      $db = "ketabkhana";

      $conn3 = mysqli_connect($host, $user, $pass, $db);
      if(mysqli_connect_error()) {
        echo "Database Connection Failed!";
        echo "<br>";
        echo $conn3 -> connect_error;
      }
      else {
        $stmt3 = mysqli_prepare($conn3, 'delete from bookdata where id=?');
        mysqli_stmt_bind_param($stmt3, 'i', $p10);
        $p10 = $id;
        mysqli_stmt_execute($stmt3);
      }
      mysqli_close($conn3);

    }

  }

?>
      <div class="form">

      <h1>Update-Delete Book</h1>

    <form name="srcForm"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return srcvalidate()"  method="POST">


     <label for="srcB">Search Book:</label>
        <input type="search" name="srcB" id="srcB" value="<?php echo $srcB;?>" placeholder="search here" style = "width: 75%; display: inline-block;">

         <input type="submit" name="src" value="Search" id="srcBtn">
        <p style="color:red"><?php echo $srcBErr; ?></p>


      </form>
      <p id="srcerrorMsg"></p>
      
      <hr>

    <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

        <label for="thumbnail">Book Thumbnail:</label>
        <input type="text" name="thumbnail" id="thumbnail" value="<?php echo $thumbnail;?>">
 
        <p style="color:red"><?php echo $thumbnailErr; ?></p>

       <label for="id">Book Id:</label>
        <input type="text" name="id" id="id" value="<?php echo $id;?>">

        <p style="color:red"><?php echo $idErr; ?></p>

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
      
       <input type="submit" name="update" value="Update" id="updateBtn">
      <input type="submit" name="delete" value="Delete" id="deleteBtn">

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
        
        
      </style>

      <script>
          function srcvalidate() {
          var isValid = false;
          var srcB = document.forms["srcForm"]["srcB"].value;
        
      if(srcB == "") 

      {
        document.getElementById("srcerrorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("srcerrorMsg").style.color = "red";

        if(srcB == "")
          document.getElementById("srcB").style.border = "2px solid red";
        else
          document.getElementById("srcB").style.border = "1px solid black";
               
      }
      else {
        isValid = true;
      }

      return isValid;
    }

    </script>

       <script>
          function validate() {
          var isValid = false;
          var thumbnail = document.forms["jsForm"]["thumbnail"].value;
          var id = document.forms["jsForm"]["id"].value;
          var booktitle = document.forms["jsForm"]["booktitle"].value;
          var bookauthor = document.forms["jsForm"]["bookauthor"].value;
          var bookpublisher = document.forms["jsForm"]["bookpublisher"].value;
          var bookedition = document.forms["jsForm"]["bookedition"].value;
          var bookprice = document.forms["jsForm"]["bookprice"].value;

      if(thumbnail == "" ||id == "" || booktitle == "" || bookauthor== ""|| bookpublisher== "" || bookedition== ""|| bookprice== "") 

      {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";

        if(thumbnail == "")
          document.getElementById("thumbnail").style.border = "2px solid red";
        else
          document.getElementById("thumbnail").style.border = "1px solid black";

         if(id == "")
          document.getElementById("id").style.border = "2px solid red";
        else
          document.getElementById("id").style.border = "1px solid black";


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
        isValid = true;
      }

      return isValid;
    }

    </script>

    </body>
</html>