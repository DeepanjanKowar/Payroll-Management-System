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
<style type="text/css">
td{
font-size:17px;
font-weight:bold;}
.copy{
 float:right;
margin-top:0em;font-size:15px;margin-right:50px;}
</style><body>
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
<a href="records.php" class="ab"><div class="bar3">Records<img src="../links/edit.png" height="25"></div></a>
<form method="post" action="profile.php" >
<input type="text" name="key" value="<?php echo $_SESSION['empno']; ?>" id="key" tabindex="1" onFocus="if (this.value == 'Search Employee ID') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Search Employee ID';} ">
    <select name="field" id="field" style="background-color="#006633" border="0" class="select">
      <option value="empno"></option>
      </select>
<input type="submit" class="info" name="save" value="Information" />
</form></a>
</div>
<div class="profile">
<a href="account.php" class="if">
<input type="submit" name="submit1" value="Add Information" class="if" align="right" /> 
</a>
<table border="0" class="profilepic" >
<tr><td >

<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM emp_info WHERE empno = $key limit 1";
      else
	  
        exit('<h6><br/></h6>');
     else
	
      $query = "SELECT * FROM emp_info WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM emp_info";
	

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

  ?>

   <?php
   
  @$image=$row ['photo'];
 ?>
<img src="image/<?php echo $image;?>" width=150"  height="150">
<form name="form" action="" method="post" enctype="multipart/form-data" class="insert">
<input type="file" name="file"  title="Change photo"/><br/>
<input type="text" name="empno" id="key" value="<?php echo $_SESSION['empno']; ?>" readonly=""/> 
<input type="submit" name="submit" value="submit" /> 

</form>
<?php
}
}

  ?>
<?php 
$con=mysql_connect( "localhost","root","shubham95");
mysql_select_db ("payroll",$con);
if(@$_POST ['submit'])
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

$query="update emp_info  set photo='$name',empno=$empno WHERE empno = $empno";

mysql_query ($query) or die ('could not updated:'.mysql_error());
@$image=$row ['photo'];
echo $image;
}

}
}
?>

</body>
</html>
<html >
<head>
</td>
</tr>
</table>

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
	  
        exit('<h6><br/><table border="0"><td bgcolor="red"><center>Please enter a numeric value!</center></td></table></h6>');
     else
	
      $query = "SELECT * FROM emp_info WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM emp_info";
	

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

  ?>
  <script type="text/javascript">
 function proceed() {
  return confirm('Delete this record?');
 }
 </script>
 <table border="0"cellspacing="6" align="center" class="information" bordercolor="#000000" style="border:solid #999 1px" >

<tr bgcolor="gray">

<tr>

   <?php
   echo '<hr width="800">';
  echo '<div class="id">'.$row['id'].'</div>';
  echo'<td>Employee No<td>:</td>';
echo '<td>'.$row['empno'].'</td></td>';
  	echo '<tr><td>Last Name<td>:</td></td><td>'.$row['lname'].'</td></tr>';
	echo '<tr><td>First Name<td>:</td></td><td>'.$row['fname'].'</td></tr>';
  echo '<tr><td>Middle I<td>:</td></td><td>'.$row['init'].'</td></tr>';
  echo '<tr><td>Department<td>:</td></td><td>'.$row['dept'].'</td></tr>';
  echo '<tr><td>Position<td>:</td></td><td>'.$row['position'].'</td></tr>';
  echo "</tr>";;
}
}
echo '</table>';
  ?>
<hr width="800"/>

<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM other_info WHERE empno = $key";
      else
	  
        exit('<h6><br/><table border="0"><td bgcolor="red"><center>Please enter a numeric value!</center></td></table></h6>');
     else
	
      $query = "SELECT * FROM other_info WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM other_info";
	

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

  ?>
  <script type="text/javascript">
 function proceed() {
  return confirm('Delete this record?');
 }
 </script>
 <table border="0"cellspacing="6" align="center" class="information" bordercolor="#000000" style="border:solid #999 1px" >

<tr bgcolor="gray">

<tr>

   <?php
   
  echo'<td>Address<td>:</td><td>'.$row['address'].'</td></td>';
  	echo '<tr><td>Contact<td>:</td></td><td>'.$row['contact'].'</td></tr>';
	echo '<tr><td>postal code<td>:</td></td><td>'.$row['post'].'</td></tr>';
	  echo '<tr><td>Gender<td>:</td></td><td>'.$row['gender'].'</td></tr>';
  echo '<tr><td>Status<td>:</td></td><td>'.$row['stat'].'</td></tr>';
  echo '<tr><td>Birthdate<td>:</td></td><td>'.$row['bdate'].'</td></tr>';
  echo "</tr>";;


  echo "<td><td></td><td><a href='edit_other.php?empno=".$row['empno']."'><input type='submit'value='Change'></td></td>";}}
echo '</table>';
   

  ?>
  
<hr width="800"/>



<div class="footer"></div>
</div>
</body>
</html>

