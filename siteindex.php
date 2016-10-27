<!DOCTYPE HTML>
<html>
<head>
<title>KRIYA SITE SETUP </title>
<style>
a:hover {
   color: black;
	font-weight:bold;
}
a:active {
   color: red;
}
<?php
session_start();
	?>
</style>
<link rel="stylesheet" type="text/css" href="style_dn_controller_tb.css">
</head>

<body>
	<p style="margin-left:5px;font-size:14px"><a style="text-decoration:none" href="siteindex.php"> HOME </a></p>
<div style="float:right;margin-top:-50px;margin-right:150px">
	<p style="font-size:14px"> Welcome &nbsp;<?php echo $_SESSION["login_user"];?>&nbsp;&nbsp;&nbsp;  <a style="text-decoration:none" href="sitelogout.php">logout </a></p>
</div>

<div id='img'><img src="exeter_premedia_services.png" alt="Exeter Premedia Services" height="25%"  width="20%" style="display: block;float:left; margin: 40px auto;">

<p style="float:right;margin-right:594px;margin-top:50px">KRIYA SITE SETUP </p>

<ul style= "float:right; margin-right:630px; list-style-type:none; margin-top:50px; list-style-type:circle; ">
<li class="indexlist" > <a href="dn_controller_tb.php" style = "text-decoration:none">SITE CREATION </a></li>
<li  class = "indexlist" style="margin-top:30px;"> <a href="createuser.php" style = "text-decoration:none">CREATE USER </a></li>
</ul>

<div>
</div>

<div class = "divindex" style="float:left; margin-top:100px; margin-left:-137px">
<!--<p> INSTRUCTIONS </p>

<ul style= "float:left; margin-left:150px; list-style-type:none; margin-top:20px; list-style-type:circle; ">
<li class="indexlist" > Create a new Site using the link Site Creation </li>
<li  class = "indexlist" style="margin-top:30px;"> CREATE USER </li>
</ul> !-->

</div>
</div>
</body>
