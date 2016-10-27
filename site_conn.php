<!DOCTYPE html>
<html>

<?php
session_start();

$hostname = "localhost";
$dbuname = "root";
$dbpwd = "root";

//Mysql connection 
$dbcon = mysqli_connect($server,$dbuname,$dbpwd);

if(!$dbcon)
{
  echo "Connection Error:" . mysqli_connect_error();
}
else
{

#echo "Connected to MySQL Successfully";

#query to check if loginid and password is correct

$sql= "SELECT user_id FROM sitesetup.login WHERE username = '$myusername' AND password = '$mypassword' ";
$result = mysqli_query($dbcon,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1)
{ 
#if loginid and password is valid redirect to siteindex page
	$_SESSION["login_user"] = $myusername;
	header("location: siteindex.php");
}
else
{
#print error message
	echo "Invalid Username or Password";
}

}

?>
