<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>

	<div class="header">
  		<?php include 'header2.php';?>
	</div>

	<div class="bg">
		<br>
		<br>
		<br>
		<P class = "home"><b>Welcome to KetabKhana</b></P>
		<br>
		<P class = "home2"><b>Discover Your Roots</b></P>
	</div>

	<div class="footer">
		<?php include 'footer.php';?>
	</div>

	<style>
		body, html {
		height: 90%;
		margin: 0;
		color: white;
		}

		.header{
			font-family: candara;
		}

		.bg {
			background-image: url('images/home.jpg');
			min-height: 100%; 
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.footer{
			color: white;
			height: 7%;
			background-color: #83888A;
		}
		
        h1{
        	text-align: center;
        }
        .home{
        	text-align: center;
        	font-size: 50px;
        	text-shadow: 4px 4px 3px #99ADC6;
        }
        .home2{
        	text-align: center;
        	font-size: 80px;
        	color: #F2A745;
        	text-shadow: 5px 3px 5px #E4C294;
        }
	</style>


</body>
</html>