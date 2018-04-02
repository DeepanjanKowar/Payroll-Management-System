<?php

// Inialize session
 session_start();

// Check, if user is already login, then jump to secured page
 if (isset($_SESSION['empno'])) {
 header('Location:/employee/employee.php');
 }

?>
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
<div class="head2">
<div class="link1">
<a href="../login page/admin.php"><p>Admin</p></a></div>
<div class="link2">
<a href="admin.php"><p>Employee</p></a></div></div>

<div class="body">:<br/><br/>
<form method="POST" action="process.php">

<table border="0" align="center" cellspacing="0" style="border:solid 1px;" >
<tr>
<td colspan="4">
<DIV class="admin">EMPLOYEE</DIV>
</td>
</tr>
<tr >
<td rowspan="4">
<img src="img/employee.png" height="150">
</td>
<td width="">

</td>
<td width="50">

</td><td height="30">

</td>
</tr>
<tr>
<td>

</td><td>
Enter&nbsp;ID:
</td><td>
<input type="text" name="empno" size="20" class="enter" />
</td>
</tr>
<tr>
<tr>
<td>
</td><td>
</td><td><input type="submit" value="Login">
</td>
</tr>
</table></label>
</span>
</form>
</div>
<div class="footer"></div>
</div>
</body>
</html>
