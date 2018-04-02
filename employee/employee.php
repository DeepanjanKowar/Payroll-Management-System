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
</div>
<style type="text/css">
.fb-like-box{margin-left:30px;}

</style>
<div class="body">


<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="http://www.facebook.com/pages/ABCcompany/455340924492485" data-width="292" data-height="300" data-show-faces="true" data-stream="false" data-header="true"></div>


<div class="footer"></div>
</div>
</body>
</html>
