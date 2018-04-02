<?php

// Inialize session
 session_start();

// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: login page/admin.php');
 }

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BIT Durg</title>
<link href="abc css.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">
 function proceed() {
  return confirm("Save this entry?");
 }
 function startTime() {
  var today=new Date();
  var h=today.getHours();
  var m=today.getMinutes();
  var s=today.getSeconds();
  // add a zero in front of numbers<10
  m=checkTime(m);
  s=checkTime(s);
  document.getElementById('txt').innerHTML=h+":"+m+":"+s;
  t=setTimeout('startTime()',500);
 }
 function checkTime(i) {
  if (i<10) {
   i="0" + i;
  }
  return i;
 }
</script>
<body>
<div class="wrapper">
<div class="abc"></div>
<div class="company"><div class="log">Welcome &nbsp;<a href="login page/logout.php" class="logout">Logout</a></div></div>
<div class="time">
<table border="0" class="tymbar">
<tr><td>
<div class="jva">
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
<div class="profile3">
</div>
<div class="body">

<div class="entry2">
<div class="head1">

Add Entry Form
</div>
  <div class="body1">
<?php
// End of insert/update if there's any	 

//Initialize input fields
$insert = 1;
$id = 0;
$empno = "";
$lname = "";
$fname = "";
$init = "";

$gendermale = "checked";
$genderfemale = "";

$bmonth0 = "selected";
$bmonth1 = "";
$bmonth2 = "";
$bmonth3 = "";
$bmonth4 = "";
$bmonth5 = "";
$bmonth6 = "";
$bmonth7 = "";
$bmonth8 = "";
$bmonth9 = "";
$bmonth10 = "";
$bmonth11 = "";
$bmonth12 = "";

$bday = "";
$byear = "";

$dept = "";
$dept0 = "selected";
$dept1 = "";
$dept2 = "";
$dept3 = "";
$dept4 = "";
$dept5 = "";
$dept6 = "";
  
$position = "";
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
  $query = "SELECT * FROM employee WHERE id = $id";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $id= 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$id= $row['id'];
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

<?php

$msg = "";

//Save record (Insert/Update)

if (isset($_POST['insert'])) {
	
	
	
  if ($_POST['insert'])
    $insert = 1;
  else
    $insert = 0;
  $id = $_POST['id'];
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
	  
    $query = "INSERT INTO employee VALUES ($id
,$empno,$pay,$dayswork,$otrate,$othrs,$allow,$advances,$insurance)";
	
$msg ="<center><table border='1' width='431'  ><td bgcolor='#009933'><center>New record saved!</center></label></table></center>";
  }
  else {
    $query = "UPDATE employee SET  id=$id,empno=$empno,pay=$pay,dayswork=$dayswork,otrate=$otrate,othrs=$othrs,allow=$allow,advances=$advances,insurance=$insurance WHERE id = $id";

    $msg = "<center><table border='1' width='300'  ><td bgcolor='#009933'><center>Record updated!</center></table></center>";

  }
  include 'include/dbconnection.php';
  
  

echo '<center>';
  $result=mysql_query ($query,$link) or die ("invalid query".mysql_error());
 echo '</center>';   
 
}

	
?>  <form method="post" action="edit.php" onSubmit="return proceed()">
<style type="text/css">
.a{
	width:400px;
    margin-left:22px;
    
	input[class=id_empno], input.id_empno{
		background:#CCC;}
	}
</style>
 <fieldset class="a" > <legend>Edit Entry</legend>
<table border="0" width="auto" align="center" >
  <tr>
  <tr><td colspan="2"><?php echo '<strong>'.$msg.'</strong>'; ?></td></tr>
    <td width="174">ID</td>
    <td width="238"><input type="text" name="id" class="id_empno" value="<?php echo $id; ?>" tabindex="1" readonly="readonly" /></td>
  <tr>
    <td width="174">Employee Number</td>
    <td width="238"><input type="text" name="empno" class="id_empno" value="<?php echo $empno; ?>" tabindex="1" readonly="readonly" /></td>
    </tr>
  <tr>
    <td>Basic Pay</td>
    <td><input type="text" name="pay" value="<?php echo $pay; ?>" tabindex="12" /></td>
  </tr>
  <tr>
    <td>Days worked</td>
    <td><input type="text" name="dayswork" value="<?php echo $dayswork; ?>" tabindex="13"/></td>
  </tr>
  <tr>
    <td>Overtime Rate/Hour</td>
    <td><input type="text" name="otrate" value="<?php echo $otrate; ?>" tabindex="14"/></td>
  </tr>
  <tr>
    <td>OT Hours</td>
    <td><input type="text" name="othrs" value="<?php echo $othrs; ?>" tabindex="15"/></td>
  </tr>
  <tr>
    <td>Allowances</td>
    <td><input type="text" name="allow" value="<?php echo $allow; ?>" tabindex="16"/></td>
  </tr>
  <tr>
    <td>Advances</td>
    <td><input type="text" name="advances" value="<?php echo $advances; ?>" tabindex="17"/></td>
  </tr>
  <tr>
    <td>Insurance</td>
    <td><input type="text" name="insurance" value="<?php echo $insurance; ?>" tabindex="18"/></td>
  </tr>
  <tr>
   <td colspan="2" align="center">
   
	<input type="submit" name="save" id="save" value="Save" tabindex="19"/>
	<input type="reset" value="Reset"></td>
  </tr>
</table>
<input type="hidden" name="insert" value="<?php echo $insert; ?>" />
</form>


</div>
<div class="foot1"></div>
</div>
</div>

<div class="footer"></div>
</div>
</body>
</html>
