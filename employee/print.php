<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payslip</title>
</head>
<style type="text/css">
body{
	background-color:#999;}
.wrapper{
	background-color:#FFF;
	width:900px;
	height:600px;
	margin:auto;
	}
.header{
	background-image:url(print/p_header.png);
	height:153px;
	width:365px;
	float:left;}
.header2{
	background-image:url(print/p_header2.png);
	height:153px;
	width:535px;
	float:left;}
.body{
	background-image:url(print/abc-online_03.png);
	
	width:900px;
	}
.name{
	background-color:#fff;
	height:50px;
	width:900px;
	float:left;

	}
.name_{
	background-color:#fff;
	height:100px;
	width:450px;
	float:left;
	}
.payslip{
	background-color:#fff;
	height:100px;
	width:450px;
	float:left;
	}
.payslip2{
	background-color:#fff;
	width:900px;
	float:left;
	}
.payslip2_{
	padding-left:25px;
	}
	td{
		font-size:16px;}
.box{	font-family:Tahoma, Geneva, sans-serif;}
.box1{
	font-weight:bold;
	opacity:0;
	font-size:1px;}
</style>

<body>

<div class="wrapper" title="Right click to print payslip">
<div class="header"><img src="print/p_header.png"></div>
<div class="header2"><img src="print/p_header2.png"></div>
<div class="body">
<div class="name"></div>
<div class="name_">
<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "id")
      if (is_numeric($key))
        $query = "SELECT * FROM employee WHERE id = $key";
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
  
  if ($gross >= 50000)
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
 
 
  
}


?>
<?php
$msg = "";

//Save record (Insert/Update)
if (isset($_POST['insert'])) {
  if ($_POST['insert'])
    $insert = 1;
  else
    $insert = 0;
  //$id = $_POST['id'];
  $empno = $_POST['empno'];
  $dept = $_POST['dept'];
  $lname = $_POST['lname'];
  $fname = $_POST['fname'];
  $init = $_POST['init'];
  $position = $_POST['position'];


  if ($insert) {
    $query = "INSERT INTO employee VALUES ($empno,'$lname','$fname','$init','$position',$pay,$dayswork,$otrate,$othrs,$allow,$advances,$insurance)";
	$msg = "New record saved!";
  }
  else {
    $query = "UPDATE employee SET empno=$empno,lname='$lname',fname='$fname',init= '$init',position='$position' WHERE id = $id";
    $msg = "Record updated!";
  }
  include 'include/dbconnection.php';
  $result=mysql_query ($query,$link) or die ("invalid query".mysql_error());
}	  
// End of insert/update if there's any	 

//Initialize input fields
$insert = 1;
//$id = 0;
$empno = "";
$dept = "";
$lname = "";
$fname = "";
$init = "";
$position = "";
//End of input field initialization

// If update then retrieve record
if (isset($_GET['empno'])) {
  $insert = 0;
  $empno= $_GET['empno'];
  $query = "SELECT * FROM emp_info WHERE empno= $empno";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $empno = 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	//$id = $row['id'];
	$empno = $row['empno'];
	$dept = $row['dept'];
	$lname = $row['lname'];
	$fname = $row['fname'];
	$init = $row['init'];
	}
	$position = $row['position'];
  }
 
?>
<style type="text/css">
.top1{
	margin-left:25px;}
</style>
<form method="post" action="entry.php" onSubmit="return proceed()">
<table border="0" align="left" width="300" class="top1" cellspacing="0">
  <tr>
    <td class="box" width="">Employee Number</td>
    <td >:<?php echo $empno; ?></td></tr>
     <tr>
    <td class="box">Department</td>
    <td>:<?php echo $dept; ?></td>
  </tr>
  <tr>
  
  <tr>
    <td class="box">Position</td>
    <td>:<?php echo $position; ?></td>
  </tr>
</table>
<input type="hidden" name="insert" value="<?php echo $insert; ?>" />

</div>
<div class="payslip">
<table border="0" align="left" width="300"  cellspacing="0">
<tr>
    <td class="box">Lastname</td>
    <td>:<?php echo $lname; ?></td>
  </tr>
  <tr>
    <td class="box">Firstname</td>
    <td>:<?php echo $fname; ?></td></tr>
  <tr>
    <td class="box">Initial</td>
    <td>:<?php echo $init; ?></td>
  </tr>
</table>
</div>
</form>
<div class="payslip2">
<div class="payslip2_"> 
<?php
// End of insert/update if there's any	 

//Initialize input fields
$insert = 1;
$id = 0;
$empno = 0;
$pay = 0;
$dayswork = 0;
$otrate = 0;
$othrs = 0;
$allow = 0;
$advances = 0;
$insurance = 0;
//End of input field initialization

// If update then retrieve record
if (isset($_GET['id'])) {
  $insert = 0;
  $id = $_GET['id'];
  $query = "SELECT * FROM employee WHERE id=$id";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $id= 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$empno = $row['empno'];
	
        $pay = $row['pay'];
        $dayswork = $row['dayswork'];
        $otrate = $row['otrate'];
	$othrs = $row['othrs'];
	$allow = $row['allow'];
	$advances = $row['advances'];
	$insurance = $row['insurance'];
  }
}
?>
<form method="post" action="entry.php" onSubmit="return proceed()">
<table width="" border="0">
<?php

$msg = "";

//Save record (Insert/Update)

if (isset($_POST['insert'])) {
	
	
	
  if ($_POST['insert'])
    $insert = 1;
  else
    $insert = 0;

  $empno = $_POST['empno'];
 
  $pay = $_POST['pay'];
  $dayswork = $_POST['dayswork'];
  $otrate = $_POST['otrate'];
  $othrs = $_POST['othrs'];
  $allow = $_POST['allow'];
  $advances = $_POST['advances'];
  $insurance = $_POST['insurance'];?>
  
<?php
  if ($insert) {
	  
    $query = "INSERT INTO employee VALUES ($id,$empno,',$pay,$dayswork,$otrate,$othrs,$allow,$advances,$insurance)";
	
$msg ="<center><table border='1' width='431'  ><td bgcolor='#009933'><center>New record saved!</center></label></table></center>";
  }
  else {
    $query = "UPDATE employee SET id=$id,empno=$empno,',pay=$pay,dayswork=$dayswork,otrate=$otrate,othrs=$othrs,allow=$allow,advances=$advances,insurance=$insurance WHERE empno = $empno";

    $msg = "<center><table border='1' width='431'  ><td bgcolor='#009933'><center>Record updated!</center></table></center>";

  }
  include 'include/dbconnection.php';
  
  

echo '<center>';
  $result=mysql_query ($query,$link) or die ("invalid query".mysql_error());
 echo '</center>';   
 
}

	
?>  
<style type="">
.align{
	word-spacing:285px;}.align1{
	word-spacing:300px;}.align3{
		float:right;}.net{
			margin-right:31px;}
</style>
<table border="1" cellspacing="0">
<tr><td align="left" class="align1"><b>Earnings  Amount</b></td>
<td class="align"><b>Deductions  Amount</b></td>
</tr>
<tr><td>
<table border="0" width="417" cellspacing="0">
   <tr>
    <td class="box1"></td>
    <td class="box1"><?php echo $id; ?></td>
  </tr>
  <tr>
    <td class="box" >Basic Pay</td>
    <td align="right"><?php echo number_format( "$pay",2); ?></td>
  </tr>
  <tr>
    <td class="box">Days worked</td>
    <td align="right"><?php echo number_format( "$dayswork",2); ?></td>
  </tr>
  <tr>
    <td class="box">Overtime Rate/Hour</td>
    <td align="right"><?php echo number_format( "$otrate",2); ?></td>
  </tr>
  <tr>
    <td class="box">OT Hours</td>
    <td align="right"><?php echo number_format( "$othrs",2); ?></td>
  </tr>
  <tr>
    <td class="box">Allowances</td>
    <td align="right"><?php echo number_format( "$allow",2); ?></td>
  </tr>
     <?
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
  <tr>
    <td class="box"></td>
    <td align="right">
</td>
  

  
</table>
</td><td width="">
<table border="0"  width="417" cellspacing="0">
 
<tr>
    <td class="box">W/Tax</td>
    <td align="right"><? echo number_format( "$tax",2);?></td>
  </tr>
  <tr>
    <td class="box">Insurance</td>
    <td align="right"><?php echo number_format( "$insurance",2); ?></td>
  </tr>
  <tr>
    <td class="box">Advances</td>
    <td align="right"><?php echo number_format( "$advances",2); ?></td>
  </tr>
   </tr>
  <tr>
    <td class="box"></td>
    <td height="40" width=""></td>
  </tr>
  
</table>
</td></tr></tr>
  <tr><td class="align2"><b>Gross Pay <div class="align3"> <?  echo number_format("$gross",2);?></div></b>
  
  </td><td ><b>Total Deductions <div class="align3"> <?php echo number_format("$totdeduct",2); ?></div></b></td></tr>
</table>
</br>
<table border="1" width="422" align="right" class="net" cellspacing="0">
<tr>
<td align="left"><b> Net Pay <div class="align3"><?php  echo number_format("$netpay",2);?></div></b></td>
</tr>
</table>
<input type="hidden" name="insert" disabled value="<?php echo $insert; ?>" />
</form></div>

</div>
</div>

</div>
</body>
</html>
