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
<div class="profile">
<?php
// End of insert/update if there's any	 

//Initialize input fields
$insert = 1;
$id = "0";
$empno = "0";
$pay = "0";
$dayswork = "0";
$otrate = "0";
$othrs = "0";
$allow = "0";
$advances = "0";
$insurance = "0";
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

$bday = "DD";
$byear = "YYYY";

//End of input field initialization

// If update then retrieve record
if (isset($_GET['id'])) {
  $insert = 0;
  $id = $_GET['id'];
  $query = "SELECT * FROM employee WHERE empno = $empno";
  include 'include/dbconnection.php';
  $result = mysql_query($query,$link) or die (mysql_error());
  if (!mysql_num_rows($result)) {
    $id = 0;
	$msg = "No record found!";
  }	
  else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$id = $row['id'];

	$empno = $row['empno'];
        $pay = $row['pay'];
        $dayswork = $row['dayswork'];
        $otrate = $row['otrate'];
	$othrs = $row['othrs'];
	$allow = $row['allow'];
	$advances = $row['advances'];
	$insurance = $row['insurance'];
switch (substr($row['time'],8,2)) {
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

	$bday = substr($row['time'],8,2);
	$byear = substr($row['time'],0,4);

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
  $pay = $_POST['pay'];
  $dayswork = $_POST['dayswork'];
  $otrate = $_POST['otrate'];
  $othrs = $_POST['othrs'];
  $allow = $_POST['allow'];
  $advances = $_POST['advances'];
  $insurance = $_POST['insurance'];
   $bmonth = $_POST['bmonth'];
  $bday = $_POST['bday'];
  $byear = $_POST['byear'];
  $time = $byear.'-'.$bmonth.'-'.$bday;?>
  <?php
mysql_connect("localhost", "root" , "shubham95" )or die("cannot connect to database server"); 
	mysql_select_db("payroll")or die("cannot select the database");
	

 if(isset($_POST['insert']))
	{	
		//check if every fields are entered
		if(!$_POST['pay'] | !$_POST['dayswork']| !$_POST['otrate']| !$_POST['othrs']| !$_POST['allow']| !$_POST['advances']| !$_POST['insurance']| !$_POST['bmonth']| !$_POST['bday']| !$_POST['byear'])
		{
			header("location:entry.php?err=1");
		}
	else if(!$_POST['empno'])
	       {
			header("location:entry.php?err=2");
			}
		else
		{
			  $id = $_POST['id'];

  $empno = $_POST['empno'];
  
 
  
  $pay = $_POST['pay'];
  $dayswork = $_POST['dayswork'];
  $otrate = $_POST['otrate'];
  $othrs = $_POST['othrs'];
  $allow = $_POST['allow'];
  $advances = $_POST['advances'];
  $insurance = $_POST['insurance'];
   $bmonth = $_POST['bmonth'];
  $bday = $_POST['bday'];
  $byear = $_POST['byear'];
  $time = $byear.'-'.$bmonth.'-'.$bday;

 

     if ($insert)      {
  	 
	  $query = "INSERT INTO employee VALUES ($id,$empno,$pay,$dayswork,$otrate,$othrs,$allow,$advances,$insurance,'$time')";
	
	?>
	<?php

$msg ="<center><table border='1' width='150' ><td bgcolor='#009933'><center>New record saved!</center></label></table></center>";

  }
	else	
{
    $query = "UPDATE employee SET id=$id,empno=$empno,pay=$pay,dayswork=$dayswork,otrate=$otrate,othrs=$othrs,allow=$allow,advances=$advances,insurance=$insurance,'time=$time' WHERE id = $id";

   $msg ="<center><table border='1' width='100' ><td bgcolor='#009933'><center>New Updated!</center></label></table></center>";

  }
  include 'include/dbconnection.php';
 
 
  

echo '<center>';
  $result=mysql_query ($query,$link) or die ("invalid query".mysql_error());
 echo '</center>';   
 
}
	}}
	   
?>  

<?php /////////////////////////////////search Area/////////////////////////////////// ?>

	
	

<?php 
if(isset($_POST['key']))
	{	
		//check if every fields are entered
		if(!$_POST['key'])
		{
			header("location:entry.php?err=1");
		}
	}
?>

<form method="post" action="entry.php">
<table cellpadding="">
  <tr>
   
    <td><input type="text" name="key" value="Search Employee ID" id="key" tabindex="1" onFocus="if (this.value == 'Search Employee ID') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Search Employee ID';}" class="search">

	
    <select name="field" id="field" style="background-color="#006633" border="0" class="select">
      <option value="empno">
	 	
	  </option>
	  
      </select>
	  &nbsp;<input type="submit" name="save" id="save" value="Search" tabindex=""/></td>

  

</form>

</table>
<canter>
<?php
		if(isset($_GET['err']))
		{
			if($_GET['err']==1)
				echo '<div class="error"><center>Please input data in field.</center></div>';
			else if($_GET['err']==2)
				echo '<div class="error"><center>No ID selected search first to select employee ID!</center></div>';
			else if($_GET['err']==3)
				echo '<div class="error">Username already exists, please use another one!</div>';
		}
		?>
        </center>
</form>





<body>


<br/>




</div>
<div class="body">
<div class="entry">

<table border="0" cellspacing="0" class="en" >  
 
<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM emp_info WHERE empno = $key";
     else
	
      $query = "SELECT * FROM emp_info WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM emp_info";
include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	echo '<label>';
  echo '<tr><tr><td bordercolor="#FFFFFF">Id no:<td width="20"></td></td><td>'.$row['empno'].'</td></tr>';
  
  echo '<td>Last name:<td></td></td><td>'.$row['lname'].'</td>';
 
  echo '<tr><td>First name:<td></td></td><td>'.$row['fname'].'</td></tr>';
   
  echo '<tr><td>Middle I.<td></td></td><td>'.$row['init'].'</td></tr>';
  
  echo '<tr><td>Position:<td></td></td><td>'.$row['position'].'</td></tr>';

 echo '<tr><td colspan="3"><input type="button" value="Edit" class="edit"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Add Entry" class="add"></td></tr>';
echo '</label>';
 // echo "<td><a href='search.php?empno=".$row['empno']."'>Delete</td>";
}
}

echo'</table>';

?>

<?php /////////////////////////////////end search Area/////////////////////////////////// ?>

</div>
<div class="entry1">
<div class="head1">

Add Entry Form
</div>
  <div class="body1">

<?php echo '<strong>'.$msg.'</strong>'; ?><form method="post" action="entryprocess.php" onSubmit="return proceed()" class="form">

<table border="0" cellspacing="0" align="center"  " class="form" >
  
    <input type="text" name="id" readonly class="id"value="<?php echo $id; ?>" tabindex="12" title="Enter Number" onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} />
    <?php 
	$result="";
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM emp_info WHERE empno = $key";
     
     else
      $query = "SELECT * FROM emp_info WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM emp_info";
include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error( ));
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	echo ' <tr>';
    echo '<td width="174">Employee ID</td>';
	echo '<td>';
  
echo '<input type="text" name="empno" value='.$row['empno'].' readonly>';

  echo '</td>';
}
}
   ?> 
 <tr>
    <td>Basic Rate</td>
    <td><input type="text" name="pay" value="<?php echo $pay; ?>" tabindex="12" title="Enter Number" onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';}  /></td>
  </tr> <tr>
    <td>Days worked</td>
    <td><input type="text" name="dayswork" value="<?php echo $dayswork; ?>" tabindex="13" title="Enter Number"onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} /></td></tr>
  
  <tr>
    <td>Overtime Rate/Hour</td>
    <td><input type="text" name="otrate" value="<?php echo $otrate; ?>" tabindex="14" title="Enter Number"onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} /></td>
  </tr>
  <tr>
    <td>OT Hours</td>
    <td><input type="text" name="othrs" value="<?php echo $othrs; ?>" tabindex="15" title="Enter Number"onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} /></td>
  </tr>
  <tr>
    <td>Allowances</td>
    <td><input type="text" name="allow" value="<?php echo $allow; ?>" tabindex="16" title="Enter Number"onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} /></td>
  </tr>
  <tr>
    <td>Advances</td>
    <td><input type="text" name="advances" value="<?php echo $advances; ?>" tabindex="17" title="Enter Number"onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} /></td>
  </tr>
  <tr>
    <td>Insurance</td>
    <td><input type="text" name="insurance" value="<?php echo $insurance; ?>" tabindex="18" title="Enter Number"onFocus="if (this.value == '0') {this.value = '';}" onBlur="if (this.value == '0')" {this.value = '0';} /></td>
  </tr>
  <td>Date Period</td>
	<center>
    <td align="center"><select name="bmonth" tabindex="7" class="bmonth" >
		 
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
	<input type="text" name="bday" value="<?php echo $bday; ?>" size="2" maxlength="2" tabindex="8" id="bday"  onFocus="if (this.value == 'DD') {this.value = '';}" onBlur="if (this.value == 'DD')" {this.value = 'DD';} />
    <input type="text" name="byear" value="<?php echo $byear; ?>" size="4" maxlength="4" tabindex="9" id="byear" onFocus="if (this.value == 'YYYY') {this.value = '';}" onBlur="if (this.value == 'YYYY')" {this.value = 'YYYY';} /></td>
	</center>
  </tr>
  <tr>
   <td colspan="2" align="center">
   
	<input type="submit" name="save" id="save" value="Save" tabindex="19"/>
	<input type="reset" value="Reset"></td>
	</td>
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
