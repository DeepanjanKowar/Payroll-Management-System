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
<title>ABC Company</title>
<link href="abc css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="wrapper">
<div class="abc"></div>
<div class="company"><div class="log">Welcome &nbsp;<a href="login page/logout.php" class="logout">Logout</a></div></div>
<div class="time">
<table border="0">
<tr><td class="tymbar">
<div class="tymbar">
<script type="text/javascript"> document.write(''+Date()+'') </script></div>
</td></tr>
</table>
</div>
<div class="link">


</div>
<div class="profile">

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
$lname = "";
$fname = "";
$init = "";
$position = "";
//End of input field initialization

// If update then retrieve record
if (isset($_GET['id'])) {
  $insert = 0;
  $id = $_GET['id'];
  $query = "SELECT * FROM emp_info WHERE id= $id";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $id = 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	//$id = $row['id'];
	$empno = $row['empno'];
	$lname = $row['lname'];
	$fname = $row['fname'];
	$init = $row['init'];

	}	  

	$position = $row['position'];
    
  }

?>

</div>
<div class="body">
<div class="namearea">
<form method="post" action="entry.php" onSubmit="return proceed()">
<table border="0" align="center" width="300" style="border:solid 1px #000">
<tr> 
   <td colspan="2" align="left" >
   <script Language="Javascript">


function printit(){  
if (window.print) {
    window.print();  
} else {
    var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0% HEIGHT=0% HEADERS=0%  CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
    WebBrowser1.ExecWB(6, 2);//Use a 1 vs. a 2 for a prompting dialog box    WebBrowser1.outerHTML = "";  
}
}
</script>

<script Language="Javascript">  
var NS = (navigator.appName == "Netscape");
var VERSION = parseInt(navigator.appVersion);
if (VERSION > 3) {
    document.write('<img src="images/print.png"height="25"title="Print"width="25"onClick="printit()">');        
}
</script>
	</td>
  </tr>
  <tr>
    <td class="box">Employee Number</td>
    <td width="">:<?php echo $empno; ?></td></tr>
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
  <tr>
    <td class="box">Position</td>
    <td>:<?php echo $position; ?></td>
  </tr>
</table>
<input type="hidden" name="insert" value="<?php echo $insert; ?>" />
</form>

<form method="post" action="entry.php" onSubmit="return proceed()">


<?php echo '<strong>'.$msg.'</strong>'; ?>
</body>
</html>

<?php ///////////////////////////////////End of Emp_info//////////////////////////////// ?>
<br/><br/>

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
    $empno = 0;
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


</style>
 
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
<table border="0" width="300" cellspacing="0" style="border:solid 1px #000">

 
   <tr>
    <td class="box1">ID</td>
    <td class="box1">:<?php echo $id; ?></td>
  </tr>
  <tr>
    <td class="box">Basic Pay</td>
    <td>:<?php echo $pay; ?></td>
  </tr>
  <tr>
    <td class="box">Days worked</td>
    <td>:<?php echo $dayswork; ?></td>
  </tr>
  <tr>
    <td class="box">Overtime Rate/Hour</td>
    <td>:<?php echo $otrate; ?></td>
  </tr>
  <tr>
    <td class="box">OT Hours</td>
    <td>:<?php echo $othrs; ?></td>
  </tr>
  <tr>
    <td class="box">Allowances</td>
    <td>:<?php echo $allow; ?></td>
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
    <td class="box">Gross Pay</td>
    <td>:<?  echo ''.$gross.'';?></td>
  </tr>
  <tr>
    <td class="box">W/Tax</td>
    <td>:<? echo ''.$tax.'';?></td>
  </tr>
  <tr>
    <td class="box">Advances</td>
    <td>:<?php echo $advances; ?></td>
  </tr>
  <tr>
    <td>Insurance</td>
    <td>:<?php echo $insurance; ?></td>
  </tr>
  <tr>
    <td class="box">Total Deductions</td>
 
    <td><?php echo  $totdeduct; ?></td>
  </tr>
  
  <tr>
    <td class="box">Net Pay</td>
    <td>:<?  echo ''.$netpay.'';?>
</td>
  

  </tr>
</table>
<input type="hidden" name="insert" disabled value="<?php echo $insert; ?>" />
</form></div>
<div class="footer"></div>
</div>
</body>
</html>
