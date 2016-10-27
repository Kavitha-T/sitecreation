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

$hostname= "localhost";
$username="root";
$password = "root";
$dbname = "";

#connect to database
$dbconnect = mysqli_connect($hostname,$username,$password,$dbname) OR DIE ("Could not connect to database, ERROR:".mysqli_connect_error());

#query to list all database in dropdown
$queryshowdb = "SHOW DATABASES";
$dblist= mysqli_query($dbconnect,$queryshowdb);

$erruname = " ";
$errpwd = " ";
$errfname = " ";
$errlname = " ";
$errdname = " ";
$errsitename = " ";
$erremail = " ";
$errcustid = " ";
$errsnode = " ";


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

#port
  if (empty($_POST["txtport"])) 
  {
    $errport= "Port Number Required";
  } 
  else 
  {
    $port = $_POST['txtport'];
	
  }

#MySQL username
  if (empty($_POST["txtdbuname"])) 
  {
    $errdbuname= "MySQL Username Required";
  } 
  else 
  {
    $dbuname = $_POST['txtdbuname'];
	
  }
#MySQL password
  if (empty($_POST["txtdbpwd"])) 
  {
    $errdbpwd= "MySQL Password Required";
  } 
  else 
  {
    $dbpwd = $_POST['txtdbpwd'];
	
  }

#sitename
  if (empty($_POST["txtsitename"]))
  {
    $errsitename= "Sitename Required";
  } 
  else 
  {
    $sitename = $_POST['txtsitename'];
  }

#firstname
if (empty($_POST["txtfname"])) 
  {
    $errfname= "FirstName Required";
  } 
  else 
  {
    $fname = $_POST['txtfname'];
  }

#lastname
if (empty($_POST["txtlname"])) 
  {
    $lname= " ";
  } 
  else 
  {
    $lname = $_POST['txtlname'];
  }

#displayname
if (empty($_POST["txtdname"])) 
  {
    $errdname= "Display Name Required";
  } 
  else 
  {
    $dname = $_POST['txtdname'];
  }

#username
  if (empty($_POST["txtuname"])) 
  {
    $erruname= "Username Required";
  } 
  else 
  {
    $username = $_POST['txtuname'];
  }

#password
  if (empty($_POST["txtpwd"])) 
  {
    $errpwd= "Password Required";
  } 
  else 
  {
    $password = $_POST['txtpwd'];
  }


#UserLevel
  if (empty($_POST["txtulevel"])) 
  {
    $errulevel= "User Level Required";
  } 
  else 
  {
    $userlevel = $_POST['txtulevel'];
  }
#Customer ID - f_id
  if (empty($_POST["txtcustid"])) 
  {
    $errcustid= "CustomerID Required";
  } 
  else 
  {
    $custid = $_POST['txtcustid'];
  }


#GroupID
  if (empty($_POST["txtgroupid"])) 
  {
    $errgroupid= "Group ID Required";
  } 
  else 
  {
    $groupid = $_POST['txtgroupid'];
  }

#Start Node
  if (empty($_POST["txtsnode"])) 
  {
    $errsnode= "Start Node Required";
  } 
  else 
  {
    $snode = $_POST['txtsnode'];
  }

#email
if (empty($_POST["txtemail"])) 
  {
    $erremail= "EMail Id Required ";
  } 
else
 {
   $email = $_POST['txtemail'];
 }

#validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
 {
   $erremail = "Invalid email";
 }
else
 {
  $emailid = $_POST['txtemail'];
 }

exec("perl create_table_user_pl.pl $server $port $dbuname $dbpwd $sitename $fname $lname $dname $username $password $emailid $userlevel $custid $groupid $snode ", $output);

}
?>
<p style="margin-left:5px;font-size:14px"><a style="text-decoration:none" href="siteindex.php"> HOME </a></p>
	<div style="float:right;margin-top:-50px;margin-right:150px">
	<p style="font-size:14px"> Welcome &nbsp;<?php echo $_SESSION["login_user"];?>&nbsp;&nbsp;&nbsp;  <a style="text-decoration:none" href="">logout </a></p>
</div>


<div id='img'><img src="exeter_premedia_services.png" alt="Exeter Premedia Services" width="60%" style="display: block; margin: 40px auto;">
</div>

<div class = "div1" style ="overflow-x:auto;">
<form action="" method="post">
<p> CREATE USER</p>

<table class = "table" cellspacing="8" cellpadding="8">

<tr>
<td><label class="label"> Server </label></td>
<td><input type = "text" class="text" name="txtserver" placeholder="Enter Server name"/>
<span style="color:red">* <?php echo $errserver; ?></span></td>
</tr>

<tr>
<td><label class="label"> Port </label></td>
<td><input type = "text" class="text" name="txtport" placeholder="Enter Port Number"/>
<span style="color:red">* <?php echo $errport; ?></span></td>
</tr>

<tr>
<td><label class="label">MySQL Username </label></td>
<td><input type = "text" class="text" name="txtdbuname" placeholder="Enter your MySQL Username"/>
<span style="color:red">* <?php echo $errdbuname; ?></span></td>
</tr>

<tr>
<td><label class="label">MySQL Password </label></td>
<td><input type = "password" class="text" name="txtdbpwd" placeholder="Enter your MySQL Password"/>
<span style="color:red">* <?php echo $errdbpwd; ?></span></td>
</tr>

<tr>
<td><label class="label"> Sitename </label></td>
<td>
<input type = "text" class="text" name="txtsitename" placeholder="Enter the Site Name"/>
<span style="color:red">* <?php echo $errsitename; ?></span>
</td>
</tr>

<tr>
<td><label class="label"> Firstname </label></td>
<td><input type = "text" class="text" name="txtfname" placeholder="Enter your FirstName" value=""/>
<span style="color:red">* <?php echo $errfname; ?></span></td>
</tr>

<tr>
<td><label class="label">Lastname</label></td>
<td><input type = "text" class="text" name="txtlname" placeholder="Enter your LastName" value=""/>
</td>
</tr>

<tr>
<td><label class="label"> Display Name </label></td>
<td><input type = "text" class="text" name="txtdname" placeholder="Enter your Display Name" value=""/>
<span style="color:red">* <?php echo $errdname; ?></span></td>
</tr>

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
<td><label class="label">E-Mail</label></td>
<td><input type = "text" class="text" name="txtemail" placeholder="Enter your EmailId" value=""/>
<span style="color:red">* <?php echo $erremail; ?></span></td>
</tr>

<tr>
<td><label class="label"> User Level </label></td>
<td><input type = "text" class="text" name="txtulevel" placeholder="Enter the User Level" value=""/>
<span style="color:red">* <?php echo $errulevel; ?></span></td>
</tr>

<tr>
<td><label class="label">Customer ID </label></td>
<td><input type = "text" class="text" name="txtcustid" placeholder="Enter the Customer ID"/>
<span style="color:red">* <?php echo $errcustid; ?></span></td>
</tr>

<tr>
<td><label class="label"> Group ID </label></td>
<td><input type = "text" class="text" name="txtgroupid" placeholder="Enter the Group ID" value=""/>
<span style="color:red">* <?php echo $errgroupid; ?></span></td>
</tr>

<tr>
<td><label class="label">Start Node </label></td>
<td><input type = "text" class="text" name="txtsnode" placeholder="Enter the Start Node"/>
<span style="color:red">* <?php echo $errsnode; ?></span></td>
</tr>

<tr>
<td><input type ="submit" value="Submit" name="submit" class="button" /></td>
<td><input type ="reset" value="Cancel" name="cancel" class="button" /></td>
</tr>

</table>

</form>
<div style="float:left">
<?php
print "<br>";
print_r($output)."<br>";
?>
</div>