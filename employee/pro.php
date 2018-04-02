<?php 
if (isset($_POST["field"])) {
  $key = strtoupper($_POST["key"]);
  $field = $_POST["field"];
  if (!empty($_POST["key"]))
    if ($field == "empno")
      if (is_numeric($key))
        $query = "SELECT * FROM profile_image WHERE empno = $key limit 1";
      else
	  
        exit('<h6><br/></h6>');
     else
	
      $query = "SELECT * FROM profile_image WHERE UPPER($field) like '$key%'";
  else
    $query = "SELECT * FROM profile_image";
	

include 'include/dbconnection.php'; 
$result = mysql_query($query,$link) or die (mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

  ?>

   <?php
   
  @$image=$row ['photo'];
 ?><img src="/employee/image/<?php echo $image;?>" class="img" width=120"  height="120">
<?php
}
}

  ?>