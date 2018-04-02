<?php

// Inialize session
 session_start();

// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: login page/admin.php');
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BIT DURG</title>
<link href="abc css.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">

.se{margin-left:20px;}
input[type=button], input.button { width:200px; background:gray;  #999; color:#CCC; font-weight:bold; margin-top:15px; cursor:pointer; width:200px; -moz-border-radius:5px; -webkit-border-radius:5px; padding:4px;
 }input[type=button]:hover, input[type=button]:focus, input.submit:hover, input.submit:focus { background:#CCC; color:#000;}
</style>
<body>
<div class="wrapper">
<div class="abc"></div>
<div class="company"><div class="log">Welcome &nbsp;<a href="login page/logout.php" class="logout">Logout</a></div></div>
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

<div class="profile5">


<form method="post" action="search.php">
<table cellpadding=""  border="0" class="se">
  <tr>
   
    <td><input type="text" name="key" value="Search Employee ID" id="key" tabindex="1" onFocus="if (this.value == 'Search Employee ID') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Search Employee ID';}">

	
    <select name="field" id="field" style="background-color="#006633" border="0" class="select">
      <option value="empno">
	 	
	  </option>
	  
      </select>
	  &nbsp;<input type="submit" name="save" id="save" value="Search" tabindex=""/></td>
      
</table>
</div>

<div class="body"
>
<?php 
//-------------------------------------------search----------------------------------//
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM emp_info WHERE empno = $key";
      else
	
        exit('<br/><h4 ><center>Please enter a numeric value!</center></h4></td>');
     else
	
      $query = "SELECT * FROM employee WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM emp_info";

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
?>
  <?php
   
  @$image=$row ['photo'];
 ?>
<style type="text/css">
.a{
	width:600px;
    margin-left:-1.5em; float:right;
  }
	input[class=id_empno], input.id_empno{
		background:#CCC;}
     	
        .src_img{ float:left; margin-left:5px;}
        .tb{ margin-letf:-1em;}.font_info{ font-size:16px;}
</style>
<br/><br/>
<div class="tb">
<table border="0" class="tb" cellspacing="0"><td>

</td><td>
 <div class="a" > <legend><table border="" cellspacing="0" style="border:gray 1px solid"><td><?php
   echo "<a href='edit_info.php?empno=".$row['empno']."'><img src='images/edit.png' height='20'width='25' border='0' title='Edit'>";
   ?></td></table></legend>

<table border="0"cellspacing="3" class="pro" >

<tr><td rowspan="4">
<img src="/soft_e/htdocs/employee/image/<?php echo $image;?>" class="img" width=120"  height="120">
  <td  class="font_info">Employee<td>:</td></td>
  <td width="20"><?php echo '<td  class="font_info">'.$row['empno'].'</td>';
  ?></td><td width="100"></td><td  class="font_info">Last Name<td>:</td></td>
  <td width="20"  class="font_info"><?php echo '<td bordercolor="#FFFFFF"  class="font_info">'.$row['lname'].'';?></td>
  
  </tr>
  
  <tr>
  <td  class="font_info">Department<td>:</td></td>
  <td width="20"  class="font_info"><?php echo '<td  class="font_info">'.$row['dept'].'</td>'; ?></td>
  <td></td><td  class="font_info">First Name<td>:</td></td>
  <td><?php echo '<td bordercolor="#FFFFFF"  class="font_info" >'.$row['fname'].'';?></td>
  </tr>
  <tr>
 <td  class="font_info" >position<td>:</td></td>
  <td  class="font_info"><?php echo '<td  class="font_info">
  '.$row['position'].'</td>'; ?></td>
  <td></td><td  class="font_info">Middle I.:<td>:</td></td>
  <td  class="font_info"><?php echo '<td bordercolor="#FFFFFF"  class="font_info">'.$row['init'].'';?></td>
  </tr>
  <tr>
</p>
<?php
  echo '</table>';
  
}

}
//--------------------------end of search---------------------------------------------//
?>
<hr width="867" align="center">
<?php //----------------------search --------------------- ?>

<table border="1"cellspacing=".1" align="center" class="search1" bordercolor="#000000" >
<tr bgcolor="gray">
<th>Emp_ID</th>
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
echo '<td bgcolor="#CCCCCC">'.$row['empno'].'</td>';
  	echo '<td>'.$row['time'].'</td>';
	echo '<td>'.$row['pay'].'.00</td>';
  echo '<td>'.$row['dayswork'].'</td>';
  echo '<td>'.$row['otrate'].'</td>';
  echo '<td>'.$row['othrs'].'</td>';
  echo '<td>'.$row['allow'].'</td>';
  echo '<td><i>';
  echo number_format("$gross",2);'</i></td>';  
  echo '<td>'.$tax.'</td>';    
  echo '<td>'.$row['advances'].'</td>';
  echo '<td>'.$row['insurance'].'</td>';
  echo '<td>';echo number_format("$totdeduct",2);'</td>';  
  echo '<td><b>';
  echo number_format("$netpay",2);'</b></td>';
  
   echo "<td><a href='edit.php?id=".$row['id']."&empno=".$row['empno']."'><img src='images/edit.png' height='20'width='25' border='0' title='Edit'></td>";
  echo '';

  echo "<td><a href='print.php?id=".$row['id']."&empno=".$row['empno']."'><img src='images/print.png' height='20'width='25' border='0' title='Print'></td>";
 // echo "<td><a href='search.php?empno=".$row['empno']."'>Delete</td>";
  echo "<td><a href='search.php?id=";
  echo $row['id'];
  echo "' onclick=";
  echo "'return proceed()";
  echo "'><img src='images/delete.png' title='Delete' height='20'width='25' border='0' '></td> </tr>";;
}
echo "<strong><center>".mysql_num_rows($result)." record(s).</center></strong></p>";

echo '</table>';
}
  ?>

</table>

</div>
<div class="footer"></div>
</div>
</body>
</html>

