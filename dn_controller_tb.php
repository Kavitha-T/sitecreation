<!DOCTYPE HTML>
<html>

<head>
<title>SITE SETUP </title>
<link rel="stylesheet" type="text/css" href="style_dn_controller_tb.css">
<script>

</script>

</head>
<body>
<?php
 
session_start();

$errsite=" ";
$errdbexisting=" ";
$output = " ";
$output2 = " ";
$errversion = " ";
$errpserver = " ";
$errwserver = " ";
$errserver = " ";
$errdbuname = " ";
$errdbpwd = " ";
$errport=" ";
$string = " ";

if($_SERVER['REQUEST_METHOD']=='POST')
{
#server
	if (empty($_POST["txtserver"])) 
  {
    $errserver= "ServerName Required";
  } 
  else 
  {
    $server = $_POST['txtserver'];
  }
#dbexisting
	if (empty($_POST["txtdbexisting"])) 
  {
    $errdbexisting= "Existing DB Name Required";
  } 
  else 
  {
    $dbexisting = $_POST['txtdbexisting'];
  }

#username
  if (empty($_POST["txtdbuname"])) 
  {
    $errdbuname= "Database Username Required";
  } 
  else 
  {
    $username = $_POST['txtdbuname'];
  }

#password
  if (empty($_POST["txtdbpwd"])) 
  {
    $errdbpwd= "Password Required";
  } 
  else 
  {
    $password = $_POST['txtdbpwd'];
  }

#port
  if (empty($_POST["txtport"])) 
  {
    $errport= "Port Number Required";
  } 
  else 
  {
    $port = $_POST['txtport'];
  }

#sitename-dbnew
  if (empty($_POST["txtsitename"])) 
  {
    $errsite= "Site Name Required";
  } 
  else 
  {
    $dbnew = $_POST['txtsitename'];
  }

#version
   if ($_POST["txtversion"] === "select") 
  {
    $errversion= "Version Required";
  } 
  else 
  {
    $version = $_POST['txtversion'];
  }

#pageserver
  if ($_POST["txtpserver"] === "select") 
  {
    $errpserver= "PageServer Required";
  } 
  else 
  {
    $pserver = $_POST['txtpserver'];
  }
 
#webserver
  if ($_POST["txtwserver"] === "select") 
  {
    $errwserver= "WebServer Required";
  } 
  else 
  {
  $wserver = $_POST['txtwserver'];
  }

exec("perl db_copy_table_exeter_pl.pl $server $dbexisting $username $password $port $dbnew $version $pserver $wserver", $output);

}
?>
<p style="margin-left:5px;font-size:14px"><a style="text-decoration:none" href="siteindex.php"> HOME </a></p>
<div style="float:right;margin-top:-50px;margin-right:150px">
	<p style="font-size:14px"> Welcome &nbsp;<?php echo $_SESSION["login_user"];?>&nbsp;&nbsp;&nbsp;  <a style="text-decoration:none" href="">logout </a></p>
</div>


<div id='img'><img src="exeter_premedia_services.png" alt="Exeter Premedia Services" width="60%" style="display: block; margin: 40px auto;">
</div>
<div> </div>
<div class = "div1" style ="overflow-x:auto;">
<form action="" method="post">
<p> SITE CREATION</p>

<table class = "table" cellspacing="8" cellpadding="8">
<tr>
<td><label class="label"> Server </label></td>
<td><input type = "text" class="text" name="txtserver" placeholder="Enter Server name"/>
<span style="color:red">* <?php echo $errserver; ?></span></td>
</tr>

<tr>
<td><label class="label"> Existing Site </label></td>
<td><input type = "text" class="text" name="txtdbexisting" placeholder="Enter the existing Site Name"/>
<span style="color:red">* <?php echo $errdbexisting; ?></span></td>
</tr>

<tr>
<td><label class="label"> DB Username </label></td>
<td><input type = "text" class="text" name="txtdbuname" placeholder="Enter your DB Username"/>
<span style="color:red">* <?php echo $errdbuname; ?></span></td>
</tr>

<tr>
<td><label class="label"> DB Password </label></td>
<td><input type = "password" class="text" name="txtdbpwd" placeholder="Enter your DB Password"/>
<span style="color:red">* <?php echo $errdbpwd; ?></span></td>
</tr>

<tr>
<td><label class="label"> Port </label></td>
<td><input type = "text" class="text" name="txtport" placeholder="Enter Port Number"/>
<span style="color:red">* <?php echo $errport; ?></span></td>
</tr>

<tr>
<td><label class="label"> New Site </label></td>
<td><input type = "text" class="text" name="txtsitename" placeholder="Enter the site-name"/>
<span style="color:red">* <?php echo $errsite; ?></span></td>
</tr>

<tr>
<td><label class="label"> Version </label></td>
<td>
<select class="dropdown" name="txtversion">  
   
      <option value = "cms-0.9.39-alpha">cms-0.9.39-alpha</option>
      <option value = "cms-0.9.40-alpha">cms-0.9.40-alpha</option>
      <option value = "cms-0.9.40-alpha-qa">cms-0.9.40-alpha-qa</option>
      <option value = "cms-0.9.40-alpha-qa">cms-0.9.40-alpha-qa-dev</option>
      <option value = "cms-0.9.40-alpha-qa">cms-0.9.40-alpha-qa-stg</option>
      <option value = "cms-kriya-bmj-abs-0.1">cms-kriya-bmj-abs-0.1</option>

</select>
<span style="color:red"> <?php echo $errversion; ?></span>
</td>
</tr>

<tr>
<td><label class="label"> Page Server </label></td>
<td>
<select class="dropdown" name="txtpserver" > 
      
      <option value = "pag3.ama.uk.com">pag3.ama.uk.com</option>
      <option value = "pag3.ama.uk.com">pag4.ama.uk.com</option>
      <option value = "pag2.ama.uk.com:8099">pag2.ama.uk.com:8099</option>
      <option value = "pag3.ama.uk.com:8099">pag3.ama.uk.com:8099</option>

</select>
<span style="color:red"> <?php echo $errpserver; ?></span>
</td>
</tr>

<tr>
<td><input type ="submit" value="Submit" name="submit" class="button" /></td>
<td><input type ="reset" value="Cancel" name="cancel" class="button" /></td>
</tr>
</table>

</form>
</div>

<div class="div">
<?php $string = print_r($output)."<br>"; ?>

</div>
</body>

</html>