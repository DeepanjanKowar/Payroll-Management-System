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
<div class="profile">
>
</div>
<div class="body">

<style type="text/css">
.a{
	width:420px;
	margin-left:30px;
	}
</style>	  
<form name="form" action="account.php" method="post" enctype="multipart/form-data" class="insert1"  onSubmit="return proceed()">

<?php
// End of insert/update if there's any	 

//Initialize input fields
$insert = 1;
$empno = 0;
$address ="";
$contact = "";
$post= "";
$stat = "";

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

$stat = "";
$stat0 = "selected";
$stat1 = "";
$stat2 = "";
$stat3 = "";
$stat4 = "";
  
//End of input field initialization

// If update then retrieve record
if (isset($_GET['empno'])) {
  $insert = 0;
  $empno = $_GET['empno'];
  $query = "SELECT * FROM other_info WHERE empno = $empno";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $empno = 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$empno = $row['empno'];
	$address = $row['address'];
	$contact = $row['contact'];
$post = $row['post'];
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

	switch ($row['stat']) {
	  case '- Select Status -':
        $stat0 = "selected"; break;
	  case 'Single':
        $stat1 = "selected"; break;
	  case 'In a relationship' :
	    $stat2 = "selected"; break;
	  case 'Married' :
	    $dept3 = "selected"; break;
	  case 'Complicated' :
	    $stat4 = "selected"; break;

	}	  

	
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
 // $id= $_POST['id'];
  $empno = $_POST['empno'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $post = $_POST['post'];
  $gender = $_POST['gender'];
  $bmonth = $_POST['bmonth'];
  $bday = $_POST['bmonth'];
  $byear = $_POST['byear'];
  $bdate = $byear.'-'.$bmonth.'-'.$bday;
  $stat= $_POST['stat'];

  
?>
<?php
mysql_connect("localhost", "root" , "shubham95" )or die("cannot connect to database server"); 
	mysql_select_db("payroll")or die("cannot select the database");
	

 if(isset($_POST['insert']))
		
    $sql = "SELECT empno FROM other_info WHERE  empno='".$empno."'";
			$resource = mysql_query($sql) or die("username check error");
			$check = mysql_num_rows($resource);
			if($check == 1)
			{
				header("location:account.php?err=3");
			}
else
  {
	  
   $query = "INSERT INTO other_info VALUES ($empno,'$address','$contact','$post','$gender','$stat','$bdate')";
	
$msg ="<center><table border='1' width='431'  ><td bgcolor='#009933'><center>New record saved!</center></label></table></center>";
  }
 
  include 'include/dbconnection.php';
  
  

echo '<center>';
  $result=mysql_query ($query,$link) or die ("invalid query".mysql_error());
 echo '</center>';   
 
}
	
	
?> 

<p>
<?php echo '<strong>'.$msg.'</strong>'; ?>
</p>

</br>
<?php
		if(isset($_GET['err']))
		{
			if($_GET['err']==1)
				echo '<div class="err"><center>Please input data in fields.</center></br><a href="account.php"><h6>Close</h6></a></div>';
			else if($_GET['err']==2)
				echo '<div class="error">Passwords didn\'t match</div>';
			else if($_GET['err']==3)
				echo '<div class="err"><center>You are already added!<a href="account.php"><h6>Close</h6></a><center></div>';
		}
		?>	<style type="text/css">
.a{
	width:420px;
	input[class=id_empno], input.id_empno{
		background:#CCC;}
	}
</style>	  
		    <fieldset class="a"> <legend>Add Information</legend>
<table border="0" width="auto" cellspacing="0" bordercolorlight="#00FF66" class="account" align="center"> 
 <tr>
    <td width="174"></td>
    <td width="238" align="center"><?php 
$con=mysql_connect( "localhost","root","shubham95");
mysql_select_db ("payroll",$con);
if(@$_POST['save'])
{
$file = $_FILES ['file'];
 $empno = $_POST['empno'];
$name = $file ['name'];
$type = $file ['type'];
$size = $file ['size'];
$tmppath = $file ['tmp_name']; 
if($name!="")
{
if(move_uploaded_file ($tmppath, 'image/'.$name))//image is a folder in which you will save image
{

$query="update emp_info set photo='$name',empno=$empno WHERE empno = $empno";
mysql_query ($query) or die ('could not updated:'.mysql_error());

}
}
}
?><input type="file" name="file" />

<input type="text" name="empno" id="key" value="<?php echo $_SESSION['empno']; ?>" readonly=""/> </td>
    </tr>

  <tr>
    <td width="174">Employee ID</td>
    <td width="238" align="center"><input type="text" class="id_empno" name="empno"  value="<?php echo $_SESSION['empno']; ?>" tabindex="1" onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} readonly=""></td>
    </tr>
  <tr>
    <td>address</td>
    <td align="center"><input type="text" class="style1" name="address" id="lname" value="<?php echo $address; ?>" tabindex="2"/></td>
  </tr>
  <tr>
    <td>Contact Number</td>
    <td align="center"><input type="text" class="style1" name="contact" value="<?php echo $contact; ?>" tabindex="3"/></td></tr>
  <tr>
    <td>Postal Code</td>
    <td align="center"><input name="post" class="style1" type="text" value="<?php echo $post; ?>" tabindex="4" size="1"/></td>
  </tr><tr>
    <td>Gender</td>
    <td><input type="radio" name="gender" value="Male" <?php echo $gendermale; ?> tabindex="5"/>Male
        <input type="radio" name="gender" value="Female" <?php echo $genderfemale; ?> tabindex="6"/>Female</td>
  </tr>

  <tr>
    <td>Status</td>
    <td align="center"><select name="stat" tabindex="10" class="dept" >
	      <option <?php echo $stat0; ?>>- Select Status -</option>
          <option <?php echo $stat1; ?>>Single</option>
          <option <?php echo $stat2; ?>>Marreid</option>
          <option <?php echo $stat3; ?>>In a relationship</option>
          <option <?php echo $stat4; ?>>Complicated</option>
        
        </select></td>
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
   <td colspan="2" align="center">
   
	<input type="submit" name="save" id="save" value="Add" tabindex="19"/>
	<input type="reset" value="Reset"></td>
  </tr>
</table>
 </fieldset>
<input type="hidden" name="insert" value="<?php echo $insert; ?>" />
</form>
</div>

<div class="footer"></div>
</div>
</body>
</html>
