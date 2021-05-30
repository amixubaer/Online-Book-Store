<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<div class="menu">

		<div class="logo">
            <img src="../images/logo.png" alt="" width="80px">
        </div>

		<div class="mid">
			<ul>
				
				<li><a href="../employee/about.php">About</a></li>
				<li><a href="#">Salary/Festival Bonus</a>
					<ul>
						<li><a href="../employee/AddSalaryBonus.php">Send Salary/Festival Bonus Report</a></li>
						<li><a href="../employee/ShowSalaryBonus.php">Show Salary/Festival Bonus</a></li>
						
					</ul>
				</li>
				<li><a href="#">Customer Order Information</a>
					<ul>
						<li><a href="../employee/CheckCustomerOrder.php">Check Customer Order</a></li>
						<li><a href="../employee/CheckRefund.php">Check Refund Request</a></li>
						<li><a href="../employee/AllRefunded.php">All Refunded Information</a></li>
					</ul>
				</li>
				<li><a href="#">Transaction History</a>
				<ul>
				    <li><a href="../employee/AddTransaction.php">Add in Transaction History</a></li>
					<li><a href="../employee/ShowTransaction.php">Show Transaction History</a></li>
				</ul>
				</li>
				<li><a href="#">Income Statement</a>
				<ul>
				    <li><a href="../employee/AddStatement.php">Add Statement</a></li>
					<li><a href="../employee/ShowStatement.php">Show Statement</a></li>
				</ul>
				</li>
				<li><a href="../employee/employeeManagement.php">Profile</a></li>
				<li><a href="../logout.php">Logout</a></li>
			</ul>
		</div>
	</div>

	<style>
		

.mid {
	position: relative;
	width: 75%;
	margin: auto;
}


.logo{
    margin-top: 3px;
    margin-left: 50px;
    width: 10%;
    float: left;
}

.menu {
	background-color: #34495e;
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
	</style>

</body>
</html>