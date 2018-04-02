
<?php

$con = mysql_connect("localhost","root","shubham95");

if (!$con)

{

die('Could not connect: ' . mysql_error());
}

mysql_select_db("payroll", $con);
$time='time';
$time = $_POST['time'];

$result = mysql_query("SELECT * FROM employee WHERE DAYOFYEAR(time) = DAYOFYEAR('$time')  AND YEAR(time) = YEAR('$time')");
//$result = mysql_query("SELECT * FROM emp_info WHERE empno(empno) = empno('$empno')");

if(mysql_num_rows($result) != 0)
{

echo "<table border='1'>

<tr>

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


</tr>";

while($row = mysql_fetch_array($result))

{
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
  $netpay = $gross - $totdeduct;echo "<tr>";
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
echo "</tr>";

}

echo "</table>";

}

else

{

echo "No records found";

}

mysql_close($con);

?>
<a href="../records.php">Back</a>