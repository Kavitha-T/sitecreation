<!DOCTYPE HTML>
<html>
<head>
<title> </title>

<style>
</style>

<link rel="stylesheet" type="text/css" href="style_dn_controller_tb.css">
</head>
<body>

<?php

$erruname = " ";
$errpwd = " ";

if($_SERVER['REQUEST_METHOD']=='POST')
{

#username
  if (empty($_POST["txtuname"])) 
  {
    $erruname= "Username Required";
  } 
  else 
  {
    $myusername = $_POST['txtuname'];
  }

#password
  if (empty($_POST["txtpwd"])) 
  {
    $errpwd= "Password Required";
  } 
  else 
  {
    $mypassword = $_POST['txtpwd'];
  }

include("site_conn.php");
}

?>


<div></div>

<div id='img'><img src="exeter_premedia_services.png" alt="Exeter Premedia Services" height="25%"  width="20%" style="display: block;float:left; margin: 40px auto;">
</div>

<div class = "div1" style ="overflow-x:auto;">

<form action="" method="post">

<p style="float:right;margin-right:688px"> SIGN IN </p>

<table class = "table" cellspacing="8" cellpadding="8">

<tr>
<td><label class="label"> Username </label></td>
<td><input type = "text" class="text" name="txtuname" placeholder="Enter a Username" value=""/>
<span style="color:red">* <?php echo $erruname; ?></span></td>
</tr>

<tr>
<td><label class="label">Password </label></td>
<td><input type = "password" class="text" name="txtpwd" placeholder="Enter a Password" value=""/>
<span style="color:red">* <?php echo $errpwd; ?></span></td>
</tr>

<tr>
<td><input type ="submit" value="LogIn" name="submit" class="button" /></td>
<td><input type ="reset" value="Cancel" name="cancel" class="button" /></td>
</tr>

</table>

</form>

<div>
</div>

</div>
</body>
