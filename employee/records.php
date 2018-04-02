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
<a  href="employee.php" class="ab"><div class="bar1">Home<img src="../links/main3.png" height="25"></div></a>
<a href="records.php" class="ab"><div class="bar3">Records<img src="../links/edit.png" height="25"></div></a><form method="post" action="profile.php" >
<input type="text" name="key" value="<?php echo $_SESSION['empno']; ?>" id="key" tabindex="1" onFocus="if (this.value == 'Search Employee ID') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Search Employee ID';} ">
    <select name="field" id="field" style="background-color="#006633" border="0" class="select">
      <option value="empno"></option>
      </select>
<input type="submit" class="info" name="save" value="Info" />
</form></a>
</div>
<div class="profile4" >

<?php
if (isset($_GET['id']) && !isset($_GET['field'])) {
 include 'include/dbconnection.php';
 $id = $_GET['id'];
 $query = "DELETE FROM employee WHERE id = $id";
 $result = mysql_query($query,$link) or die (mysql_error());
 $msg = "Record deleted!";
}
$msg = ""; 
?>
<?php
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
			header("location:records.php?err=1");
		}
	}
	//------------------------------------------------------->>
?>
<table border="0" width="576" class="searchdate" style="border:#999 1px solid;">
<tr><td><?php 
$time='(EX.YYYY-MM-DD)';
include 'a/a.php';   ?></td><td><br/>
<form method="post" action="records.php" >
<input type="text" name="key" value="<?php echo $_SESSION['empno']; ?>" id="key" tabindex="1" onFocus="if (this.value == 'Search Employee ID') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Search Employee ID';} ">
    <select name="field" id="field" style="background-color="#006633" border="0" class="select">
      <option value="empno"></option>
      </select>
 <input type="submit" name="save" value="View all"/></form>
 
</td></tr>
</table>


</div>
<div class="body">
<style type="text/css">
.td{font-size:18px;
font-family:inherit;
}
</style>
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
  else
    $query = "SELECT * FROM emp_info";

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
?>
<p>

<table border="0"cellspacing="0" class="pro" >
<tr>
  <td class="td">Employee No.<td>:</td></td>
  <td width="50" class="td"><?php echo '<td  class="td" >'.$row['empno'].'</td>';
  ?></td><td width="300" class="td"></td></td><td class="td">Last Name<td>:</td></td><td width="50"></td><td><?php    echo '<td class="td">'.$row['lname'].'</td>'; ?></td>
  <tr>

  <td class="td">Department<td>:</td></td>
  <td class="td"><?php    echo '<td class="td">'.$row['dept'].'</td>'; ?></td>
 <td></td></td><td class="td">First Name<td>:</td></td><td></td><td class="td"><?php    echo '<td class="td">'.$row['fname'].'</u></td>'; ?></td> </tr>
 <tr>
  <td class="td">Position<td>:</td></td>
  <td class="td"><?php    echo '<td class="td">'.$row['position'].'</td>'; ?></td>
  <td></td></td><td class="td">Middle I<td>:</td></td><td></td><td class="td"><?php    echo '<td class="td">'.$row['init'].'</td>'; ?></td></tr>
<tr>  
</p>
<?php
  echo '</table>';
 
}

}

?>
<hr width="800"/> <table border="1"cellspacing=".1" align="center" class="search1" bordercolor="#000000" >
<tr bgcolor="#006600">
   <th>Date Period</th>
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
   <th>Print</th>


 

<tr>
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
  <script type="text/javascript">
 function proceed() {
  return confirm('Delete this record?');
 }
 </script>
  <?php
  echo '<div class="id">'.$row['id'].'</div>';

  	echo '<td>'.$row['time'].'</td>';
	echo '<td>'.$row['pay'].'</td>';
  echo '<td>'.$row['dayswork'].'</td>';
  echo '<td>'.$row['otrate'].'</td>';
  echo '<td>'.$row['othrs'].'</td>';
  echo '<td>'.$row['allow'].'</td>';
  echo '<td><i>';
  echo number_format("$gross",2);'</i></td>';  
  echo '<td>'.$tax.'</td>';    
  echo '<td>'.$row['advances'].'</td>';
  echo '<td>'.$row['insurance'].'</td>';
  echo '<td>';
  echo number_format("$totdeduct",2);'</td>';  
  echo '<td><b>';
  
 echo number_format("$netpay",2);'</b></td>';
  
   echo "</td>";
  echo '';

  echo "";
   echo "<td><a href='print.php?id=".$row['id']."&empno=".$row['empno']."'><img src='images/print.png' height='20'width='25' border='0' title='Print'></td>";
 // echo "<td><a href='search.php?empno=".$row['empno']."'>Delete</td>";
  echo " </tr>";;
}
echo "<p><strong><center>".mysql_num_rows($result)." record(s).</center></strong></p>";
echo '</table>';
}
  ?>

</table>
<hr width="800"/>


<div class="footer"></div>
</div>
</body>
</html>
