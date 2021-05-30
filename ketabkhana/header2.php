<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<!--<link rel="stylesheet" href="css/styleHome.css">-->
</head>
<body>
	<div class="menu">
		<div class="logo">
			<img src="images/logo.png" alt="" width="80px">
		</div>
		<div class="mid">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="bookListHome.php">Products</a></li>
				<li><a href="aboutHome.php">About</a></li>
				<li><a href="support.php">Support</a></li>
				<li><a href="preRegister.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>
	</div>

	<style>
		
.mid {
	position: relative;
	width: 40%;
	margin: auto;
}

.menu {
	background-color: #34495e;
}

.menue ul{
	margin-left: auto;
	margin-right: auto;
}

.menu ul li {

	list-style:none;
	display: inline-block;
	position: relative;
}

.menu ul li a{
	text-align: center;
	text-decoration: none;
	color: #FFF;
	padding: 20px 28px;
	display: block;
	border-bottom: 3px solid red;
}

.menu ul li a:hover {
	background-color: #2c3e50;
	border-bottom: 3px solid red;
}

.menu ul li  ul li {
	display: block;
	background-color: #34495e;
	margin-top: 3px;
	transition: .4s;
}

.menu ul li  ul  {
	position: absolute;
	top: 100%;
	left: 0px;
	width: 200px;
	display: none;
}

.menu ul li:hover ul {
	display: block;
}

.menu ul li  ul li:hover {
	transform: scale(1.5);
	z-index: 999;
}

.logo{
	margin-top: 3px;
	margin-left: 50px;
	width: 10%;
	float: left;
}	
	</style>

</body>
</html>