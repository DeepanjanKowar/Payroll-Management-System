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
<title>ABC Company</title>
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
<div class="profile">
</div>
<div class="body">

<div class="entry2">
<div class="head1">

Edit Employee Information
</div>
  <div class="body1">
<?php
// End of insert/update if there's any	 

//Initialize input fields
$insert = 1;
$id ="";
$lname = "";
$fname = "";
$init= "";
$gendermale = "checked";
$genderfemale = "";

$dept = "";
$dept0 = "selected";
$dept1 = "";
$dept2 = "";
$dept3 = "";
$dept4 = "";
$dept5 = "";
$dept6 = "";

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
  $position= "";
  //End of input field initialization

// If update then retrieve record
if (isset($_GET['empno'])) {
  $insert = 0;
  $empno = $_GET['empno'];
  $query = "SELECT * FROM emp_info WHERE empno = $empno";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $empno = 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$id = $row['id'];
			$empno = $row['empno'];
	$lname = $row['lname'];
	$fname = $row['fname'];
	$init = $row['init'];

	if ($row['gender'] == 'Male') {
	  $gendermale = "checked"; 
	  $genderfemale = ""; }
  	else {
	  $gendermale = "";
	  $genderfemale = "checked"; }

	switch (substr($row['bdate'],8,2)) {
	  case '01':
	    $bmonth1 = "selected"; break;
	  case '02':	
	    $bmonth2 = "selected"; break;
	  case '03':	
	    $bmonth3 = "selected"; break;
	  case '04':	
	    $bmonth4 = "selected"; break;
	  case '05':	
	    $bmonth5 = "selected"; break;
	  case '06':	
	    $bmonth6 = "selected"; break;
	  case '07':	
            $bmonth7 = "selected"; break;
	  case '08':	
	    $bmonth8 = "selected"; break;
	  case '09':	
	    $bmonth9 = "selected"; break;
	  case '10':	
	    $bmonth10 = "selected"; break;
	  case '11':	
	    $bmonth11 = "selected"; break;
	  case '12':	
	    $bmonth12 = "selected"; break;
	}	

	$bday = substr($row['bdate'],8,2);
	$byear = substr($row['bdate'],0,4);

	switch ($row['dept']) {
	  case '- Select Department -':
        $dept0 = "selected"; break;
	  case 'Accounting':
        $dept1 = "selected"; break;
	  case 'Marketing' :
	    $dept2 = "selected"; break;
	  case 'IT' :
	    $dept3 = "selected"; break;
	  case 'Accounting' :
	    $dept4 = "selected"; break;
	  case 'R&D' :
	    $dept5 = "selected"; break;
	  case 'Administration' :
        $dept6 = "selected"; break;
	  case 'Production' :
	    $dept6 = "selected"; break;
	}	  
 $position= $row['position'];
	
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

  $empno = $_POST['empno'];
  $lname = $_POST['lname'];
  $fname = $_POST['fname'];
  $init = $_POST['init'];
  $gender = $_POST['gender'];
  $bmonth = $_POST['bmonth'];
  $bday = $_POST['bmonth'];
  $byear = $_POST['byear'];
  $bdate = $byear.'-'.$bmonth.'-'.$bday;
  $dept = $_POST['dept'];
    $position = $_POST['position'];
  ?>
 
<?php
  if ($insert) {
	  
    $query = "INSERT INTO emp_info VALUES ($id
,$empno,$lname,$fname,$init,$dept,$position)";
	
$msg ="<center><table border='1' width='431'  ><td bgcolor='#009933'><center>New record saved!</center></label></table></center>";
  }
  else {
    $query = "UPDATE emp_info SET  empno=$empno,lname='$lname',fname='$fname',init='$init',gender='$gender',bdate='$bdate',dept='$dept',position='$position' WHERE empno = $empno";

    $msg = "<center><table border='1' width='300'  ><td bgcolor='#009933'><center>Record updated!</center></table></center>";

  }
  include 'include/dbconnection.php';
  
  

echo '<center>';
  $result=mysql_query ($query,$link) or die ("invalid query".mysql_error());
 echo '</center>';   
 
}

	
?> 
 <form method="post" action="edit_info.php" onSubmit="return proceed()">
 <style type="text/css">
.a{
	width:400px;
    margin-left:22px;
    
	input[class=id_empno], input.id_empno{
		background:#CCC;}
	}
</style>	  
		    <fieldset class="a" > <legend>Edit employee information</legend>

<table border="0" width="auto" align="center" >
  <tr>
  <tr><td colspan="2"><?php echo '<strong>'.$msg.'</strong>'; ?></td></tr>
    <td width="174">ID</td>
    <td width="238"><input type="text" name="id" class="id_empno" value="<?php echo $id; ?>" tabindex="1" readonly="readonly" /></td>
    <tr>
    <td width="174">Employee ID</td>
    <td width="238" align="center"><input type="text" name="empno" class="style1" value="<?php echo $empno; ?>" tabindex="1" onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';}></td>
    </tr>
  <tr>
    <td>Lastname</td>
    <td align="center"><input type="text" class="style1" name="lname" id="lname" value="<?php echo $lname; ?>" tabindex="2"/></td>
  </tr>
  <tr>
    <td>Firstname</td>
    <td align="center"><input type="text" class="style1" name="fname" value="<?php echo $fname; ?>" tabindex="3"/></td></tr>
  <tr>
    <td>Initial</td>
    <td align="center"><input name="init" class="style1" type="text" value="<?php echo $init; ?>" tabindex="4" size="1" maxlength="1"/></td>
  </tr>
  <tr>
    <td> Gender</td>
    <td>&nbsp;&nbsp;&nbsp; <input type="radio" name="gender" value="Male" <?php echo $gendermale; ?> tabindex="5"/>Male
        <input type="radio" name="gender" value="Female" <?php echo $genderfemale; ?> tabindex="6"/>Female</td>
  </tr>
  <tr>
    <td>Birthday</td>
	<center>
    <td align="center"><select name="bmonth" tabindex="7" class="bmonth" >
		  <option value="" <?php echo $bmonth0; ?>><center>-MM-</center></option>
		  <option value="01" <?php echo $bmonth1; ?>>January</option>
		  <option value="02" <?php echo $bmonth2; ?>>February</option>
  		  <option value="03" <?php echo $bmonth3; ?>>March</option>
		  <option value="04" <?php echo $bmonth4; ?>>April</option>
		  <option value="05" <?php echo $bmonth5; ?>>May</option>
		  <option value="06" <?php echo $bmonth6; ?>>June</option>
		  <option value="07" <?php echo $bmonth7; ?>>July</option>
		  <option value="08" <?php echo $bmonth8; ?>>August</option>
		  <option value="09" <?php echo $bmonth9; ?>>September</option>
		  <option value="10" <?php echo $bmonth10; ?>>October</option>
		  <option value="11" <?php echo $bmonth11; ?>>November</option>
		  <option value="12" <?php echo $bmonth12; ?>>December</option>
    	</select>
	<input type="text" name="bday" class="style1" value="<?php echo $bday; ?>" size="2" maxlength="2" tabindex="8" id="bday"  onFocus="if (this.value == 'DD') {this.value = '';}" onBlur="if (this.value == 'DD')" {this.value = 'DD';} />
    <input type="text" name="byear" class="style1" value="<?php echo $byear; ?>" size="4" maxlength="4" tabindex="9" id="byear" onFocus="if (this.value == 'YYYY') {this.value = '';}" onBlur="if (this.value == 'YYYY')" {this.value = 'YYYY';} /></td>
	</center>
  </tr>
  <tr>
    <td>Department</td>
    <td align="center"><select name="dept" tabindex="10" class="dept" >
	      <option <?php echo $dept0; ?>>- Select Department -</option>
          <option <?php echo $dept1; ?>>Accounting</option>
          <option <?php echo $dept2; ?>>Marketing</option>
          <option <?php echo $dept3; ?>>IT</option>
          <option <?php echo $dept4; ?>>R&D</option>
          <option <?php echo $dept5; ?>>Administration</option>
          <option <?php echo $dept6; ?>>Production</option>
        </select></td>
  </tr>
  <tr>
    <td>Position</td>
    <td align="center"><input type="text" class="style1" name="position" value="<?php echo $position; ?>"tabindex="11"/></td>
  </tr
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
