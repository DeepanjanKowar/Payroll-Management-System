<style type="text/css">
.format{
	color:#333;
	text-align:center;}
</style>
<div class="format">Format should be YYYY-MM-DD</div>

<form name="input" action="date.php" method="POST">

Enter a date to search:

<input type="text" name="time" Value="(Ex. YYYY-MM-DD)" onFocus="if (this.value == '(Ex. YYYY-MM-DD)') {this.value = '';}" onBlur="if (this.value == '(Ex. YYYY-MM-DD)')" {this.value = '(Ex. YYYY-MM-DD)';} />
<input type="text=" name="empno" value="<?php echo $_SESSION['empno'];?>" class="key" />
<input type="submit" value="Search" />


</form>