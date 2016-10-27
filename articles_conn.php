<!DOCTYPE html>
<html>

<?php
session_start();

$hostname = "localhost";
$dbuname = "root";
$dbpwd = "root";
$dbname = "training";

$clienttype = "customer";

$attribute = "type=\"".$clienttype."\" image=\"".$image_name."\" publication_path\" = \" ".$publpath."\" publication_header =\"Publications\" welcome_header= \"Welcome to Exeter Premedia\" welcome_image=\"/images/exeter_logo_bw.png\" ";
echo $attribute;

$client_f_id = 2;
//Mysql connection 
$dbcon = mysqli_connect($server,$dbuname,$dbpwd);

if(!$dbcon)
{
  echo "Connection Error:" . mysqli_connect_error();
}
else
{

#echo "Connected to MySQL Successfully";

#query to insert details in t-artilcles table

#$sql= "INSERT INTO $dbname.t_articles (f_id,f_attribute,f_text) VALUES ($client_f_id,'$attribute','$clientname') ";

#f_children

if(mysqli_query($dbcon,$sql))
{
	echo "Data inserted successfully";
}
else
{
	echo "Error in inserting data". $sql ."<br>" .mysqli_error($dbcon);
}


}

?>
