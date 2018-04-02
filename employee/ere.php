<?php

// Inialize session
 session_start();

// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['empno'])) {
 header('Location: admin.php');
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BIT Durg</title>
<link href="abc css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="wrapper">
<div class="abc"></div>
<div class="company"><div class="log">Welcome &nbsp;<a href="logout.php" class="logout">Logout</a></div></div>
<div class="time">
<table border="0">
<tr><td>
<div class="tymbar">
<script type="text/javascript"> document.write(''+Date()+'') </script></div>
</td></tr>
</table>
</div>
<div class="link">
<a  href="abc.php" class="ab"><div class="bar1">Home<img src="../links/main3.png" height="25"></div></a>
<a href="entry.php" class="ab"><div class="bar2">Profile<img src="../links/entry.png" height="25"></div></a>
<a href="add.php" class="ab"><div class="bar3">Records<img src="../links/edit.png" height="25"></div></a>
<a href="search.php" class="ab"><div class="bar4">Settings<img src="../links/2.PNG" height="25"></div></a>

</div>
<div class="profile"><?php
		if(isset($_GET['err']))
		{
			if($_GET['err']==1)
				echo '<div class="error"><center>Please input data in field.</center></div>';
			else if($_GET['err']==2)
				echo '<div class="error">Passwords didn\'t match</div>';
			else if($_GET['err']==3)
				echo '<div class="error">Username already exists, please use another one!</div>';
		}
		?>
        <?php 
if(isset($_POST['key']))
	{	
		//check if every fields are entered
		if(!$_POST['key'])
		{
			header("location:employee.php?err=1");
		}
	}
?>

<center>
  <form method="post" action="employee.php">
    <table border="0" cellspacing="0" bgcolor="" align="left" class="td">
          
      <td bgcolor="#cccccc"><input type="text" value="<?php echo $_SESSION['empno']; ?>" name="key" id="key" tabindex="1" readonly/>
          <select name="field" id="field" style="background-color:#999"class="select">
            <option value="empno"></option>
          </select>
          <input type="submit" name="save" id="save" value="Click to view records" tabindex="19"/>
        </td>
    </table>
  </form>
</div>
<div class="body">
<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM emp_info WHERE empno = $key";
      else
	  
        exit('<br/><table border="0"><td bgcolor="red"><h4><center>Please enter a numeric value!</center></h4></td></table>');
     else
	
      $query = "SELECT * FROM employee WHERE UPPER($field) like '$key%'";

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
?>
<p>
<table border="0"cellspacing="0" bgcolor="#CCCCCC" height="170" >
<tr>
<?php


  ?>

</div>
<div class="bodyryt">
<div class="logout">
</div>

</div>
<div class="body">
</tr>
<tr>
  <td >Employee:</td>
  <td width="170" height=""><?php echo '<td bordercolor="#FFFFFF" ><u>'.$row['empno'].'</u></td>';
  ?></td>
</tr>
  <tr>
  <td>Lastname:</td>
  <td><?php echo '<td><u>'.$row['lname'].'</u></td>'; ?></td>
  </tr>
  <tr>
  <td>Firstname:</td>
  <td><?php echo '<td><u>'.$row['fname'].'</u></td>'; ?></td>
  </tr>
  <tr>
  <td>M.I:</td>
  <td><?php    echo '<td><u>'.$row['init'].'</u></td>'; ?></td>
  </tr>
 <tr>
  <td>Position:</td>
  <td><?php    echo '<td><u>'.$row['position'].'</u></td>'; ?></td>
</tr>
<tr>
</p>
<?php
  echo '</table>';
}

}

?>
<br/><br/>
<table border="1" cellspacing="0 " align="center" width="900" class="pay">
<tr bgcolor="#006600">

 <th >Employee Number</th>
 
   <th>Basic Pay</th>
  <th>Days Worked</th>
  <th>Overtime Rate/Hr</th>
  <th>OT Hours</th>
  <th>Allowances</th>
  <th>Gross Pay</th>
  <th>W/Tax</th>
  <th>Advances</th>
  <th>Insurance</th>
  <th>Total Deductions</th>
  <th>Net Pay</th>
   <th  >Date Period</th>


 

<tr>
<?php
if (isset($_GET['empno']) && !isset($_GET['field'])) {
 include 'include/dbconnection.php';
 $empno = $_GET['empno'];
 $query = "DELETE FROM employee WHERE empno = $empno";
 $result = mysql_query($query,$link) or die (mysql_error());
 $msg = "Record deleted!";
}
$msg = ""; 
?>
<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM employee WHERE empno = $key";
      else
	  
        exit('<h6><br/><table border="0"><td bgcolor="red"><center>Please enter a numeric value!</center></td></table></h6>');
     else
	
      $query = "SELECT * FROM employee WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM employee";

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
  $gross = ($row['pay'] * $row['dayswork']) + ($row['otrate'] * $row['othrs']) + $row['allow'];

  if ($gross>=50000)
   $tax = $gross * .15;
  if ($gross>=30000 && $gross <=49999)
   $tax = $gross * .10;
  if ($gross>=10000 && $gross <=29999)
   $tax = $gross * .05;
  if ($gross>=5000 && $gross <=9999)
   $tax = $gross * .03;
  if ($gross < 5000)
	$tax = 0;
	
  $totdeduct = $tax + $row['advances'] + $row['insurance']; 
  $netpay = $gross - $totdeduct;
  ?>
  
  <?php
  
    echo '<tr><td bordercolor="#FFFFFF">'.$row['empno'].'</td>';
	echo '<td>'.$row['pay'].'</td>';
  echo '<td>'.$row['dayswork'].'</td>';
  echo '<td>'.$row['otrate'].'</td>';
  echo '<td>'.$row['othrs'].'</td>';
  echo '<td>'.$row['allow'].'</td>';
  echo '<td><i>'.$gross.'</i></td>';  
  echo '<td>'.$tax.'</td>';    
  echo '<td>'.$row['advances'].'</td>';
  echo '<td>'.$row['insurance'].'</td>';
  echo '<td>'.$totdeduct.'</td>';  
  echo '<td><b>'.$netpay.'</b></td>';
  echo '<td class="date
   ">'.$row['time'].'</td>';
  
  }
echo '</table>';
}
  ?>

</div>

<div class="footer"></div>
</div>
<div class="footer"></div>
</div>
</body>
</html>
