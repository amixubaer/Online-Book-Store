<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<!--<link rel="stylesheet" href="css/style.css">-->
</head>
<body>
	<div class="menu">
		<div class="logo">
			<img src="../images/logo.png" alt="" width="80px">
		</div>
		<div class="mid">
			
			<ul>
				<li><a href="bookList.php">Products</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="#">Admin</a>
					<ul>
						<li><a href="adminAdd.php">Add Admin</a></li>
						<li><a href="adminList.php">Show all Admins</a></li>
						<li><a href="adminUD.php">Update/delete Admin</a></li>
					</ul>
				</li>
				<li><a href="#">Employee</a>
					<ul>
						<li><a href="employeeAdd.php">Add Employee</a></li>
						<li><a href="employeeList.php">Show all Employees</a></li>
						<li><a href="employeeUD.php">Update/delete Employee</a></li>
					</ul>
				</li>
				<li><a href="#">Shop</a>
					<ul>
						<li><a href="shopList.php">Show all Shops</a></li>
						<li><a href="shopUD.php">Update/delete Shop</a></li>
					</ul>
				</li>
				<li><a href="#">User</a>
					<ul>
						<li><a href="userList.php">Show all Users</a></li>
						<li><a href="userUD.php">Update/delete User</a></li>
					</ul>
				</li>
				<li><a href="#">Accounts</a>
					<ul>
						<li><a href="ShowStatement.php">Income Statement</a></li>
						<li><a href="ShowTransaction.php">Transaction History</a></li>
						<li><a href="ShowSalaryBonus.php">Salary & Bonus</a></li>
						<li><a href="SalaryApproval.php">Salary & Bonus Approval</a></li>
					</ul>
				</li>
				<li><a href="order.php">Order</a></li>
				<li><a href="checkSupport.php">Check Support</a></li>
				<li><a href="profileUD.php">Profile</a></li>
				<li><a href="../logout.php">Logout</a></li>
			</ul>
		</div>
	</div>

	<style>
		
.mid {
	position: relative;
	width: 70%;
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