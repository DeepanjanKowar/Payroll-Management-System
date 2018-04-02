<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BIT Durg</title>
		<link href="login.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="wrapper">
			<div class="header"></div>
			<div class="head2"></div>
			<div class="body">
				<br/><br/>
			</div>
			<div class="footer"></div>
		</div>
	</body>
</html>
<?php
// Include database connection settings
 include('config.inc.php');

// Retrieve username and password from database according to user's input
 $login = mysql_query("SELECT * FROM emp_info WHERE (empno = '" . mysql_real_escape_string($_POST['empno']) . "') ");

// Check username and password match
 if (mysql_num_rows($login) == 1) {
 // Set username session variable
 $_SESSION['empno'] = $_POST['empno'];
 // Jump to secured page
 //header('Location:/employee/employee.php');
 echo("<script>location.href = '../employee/employee.php';</script>");
 }
 else {
 // Jump to login page
 //header('Location: error.php');
 echo("<script>location.href = 'error.php';</script>");
 }

?>