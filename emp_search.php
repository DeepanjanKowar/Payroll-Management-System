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
<div class="company"></div>
<div class="time">
<table border="0">
<tr><td>
<div class="tymbar">
<script type="text/javascript"> document.write(''+Date()+'') </script></div>
</td></tr>
</table>
</div>
<div class="link">
<a  href="abc.php" class="ab"><div class="bar1">Home<img src="links/main3.png" height="25"></div></a>
<a href="entry.php" class="ab"><div class="bar2">Entry<img src="links/entry.png" height="25"></div></a>
<a href="add.php" class="ab"><div class="bar3">Add<img src="links/edit.png" height="25"></div></a>
<a href="search.php" class="ab"><div class="bar4">Search<img src="links/2.PNG" height="25"></div></a>
</div>
<div class="profile">
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
			header("location:search.php?err=1");
		}
	}
?>
<center>

<form method="post" action="search.php">
<table cellpadding=""  border="0">
  <tr>
   
    <td><input type="text" name="key" value="Search Employee ID" id="key" tabindex="1" onFocus="if (this.value == 'Search Employee ID') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Search Employee ID';}">

	
    <select name="field" id="field" style="background-color="#006633" border="0" class="select">
      <option value="empno">
	 	
	  </option>
	  
      </select>
	  &nbsp;<input type="submit" name="save" id="save" value="Search" tabindex=""/></td>

  

</form>

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
  else
    $query = "SELECT * FROM emp_info";

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
?>
<p>
<table border="0"cellspacing="0" bgcolor="#FFFFFF" class="pro">
<tr>
  <td>Employee:</td>
  <td width="20"><?php echo '<td bordercolor="#FFFFFF" ><u>'.$row['empno'].'</u></td>';
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

 <table border="1"cellspacing=".1" align="center" class="search" bordercolor="#000000" >
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
  <th colspan="3">Action</th>

 

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
}
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
  echo '<td><i>'.$gross.'</i></td>';  
  echo '<td>'.$tax.'</td>';    
  echo '<td>'.$row['advances'].'</td>';
  echo '<td>'.$row['insurance'].'</td>';
  echo '<td>'.$totdeduct.'</td>';  
  echo '<td><b>'.$netpay.'</b></td>';
  
   echo "<td><a href='edit.php?id=".$row['id']."'><img src='images/edit.png' height='20'width='25' border='0' title='Edit'></td>";
  echo '';

  echo "<td><a href='preview.php?empno=".$row['empno']."'><img src='images/print.png' height='20'width='25' border='0' title='Print'></td>";
 // echo "<td><a href='search.php?empno=".$row['empno']."'>Delete</td>";
  echo "<td><a href='search.php?id=";
  echo $row['id'];
  echo "' onclick=";
  echo "'return proceed()";
  echo "'><img src='images/delete.png' title='Delete' height='20'width='25' border='0' '></td> </tr>";;
}
echo "<p><strong><center>".mysql_num_rows($result)." record(s).</center></strong></p>";
echo '</table>';

  ?>

</table>
</div>

<div class="footer"></div>
</div>
</body>
</html>
