<!DOCTYPE HTML>
<html>

<head>
<title>SITE SETUP </title>
<link rel="stylesheet" type="text/css" href="style_dn_controller_tb.css">
	<script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>

<script type="text/javascript">

 $(document).ready(function(){
	 var count=2;
$("#addjournal").click(function (e) {
	
 $("#table1").append('<tr><td><label class="label">Journal Name </label></td><td><input name="journalname[]" type="text" /><button class="delete">Delete</button></td></tr>');
});
 $("#table1").on("click", ".delete", function (e) {
	e.preventDefault();$(this).closest('tr').remove();
});
 });
</script>

</head>
<?php
$errcname = "";
if($_SERVER['REQUEST_METHOD']=='POST')
{

#clientname
  if (empty($_POST["txtclientname"])) 
  {
    $errcname= "ClientName Required";
  } 
  else 
  {
    $clientname = $_POST['txtclientname'];
  }

#clientimage
  if(isset($_POST['submit']))
  {

     $errors= array();
     $image_name = $_POST['clientimage']['name'];
     $image_size =$_POST['clientimage']['size'];
     $image_tmp =$_POST['clientimage']['tmp_name'];
     $image_type=$_POST['clientimage']['type'];
     $image_ext=strtolower(end(explode('.',$_POST['clientimage']['name'])));
 
     $expensions= array("jpeg","jpg","png");
        move_uploaded_file($image_tmp,"images/".$image_name);
        echo "Success";
	  echo"<br>";
 echo "Image name is" .$image_name."<br>";
 echo "Image size is" .$image_size."<br>";
 echo "Image tmp is" .$image_tmp."<br>";
 echo "Image type is" .$image_type."<br>";
 
  }

#Publication Path
if (empty($_POST["clientpublpath"])) 
  {
  $errpublpath ="Publication Path Required";
  }

else 
  {
  $publpath = $_POST["clientpublpath"];
  }

#journalname
if (empty($_POST["txtclientname"])) 
  {
    $errjname= "JournalName Required";
  } 
  else 
  {
  $journalname = $_POST['journalname'];
  }
foreach ( $journalname as $value) 
  {
   echo $value; 
  }
include("articles_conn.php");
}
?>

<body>
<div id='img'><img src="exeter_premedia_services.png" alt="Exeter Premedia Services" width="60%" style="display: block; margin: 40px auto;">
</div>
<div> </div>
<div class = "div1" style ="overflow-x:auto;">
<form action="" method="post">
<p>  </p>

<table id ="table1" class = "table" cellspacing="8" cellpadding="8">

<tr>
<td><label class="label">Client Name </label></td>
<td><input type = "text" class="text" name="txtclientname" placeholder="Enter the Client Name"/>
<span style="color:red">* <?php echo $errcname; ?></span></td>
</tr>

<tr>
<td><label class="label">Image </label></td>
<td>
	<input type="file" name="clientimage" />
	<span style="color:red">* <?php echo $errimage; ?></span>
</td>
</tr>

<tr>
<td><label class="label">Publication Path </label></td>
<td><input type = "text" class="text" name="clientpublpath" placeholder=""/>
<span style="color:red">* <?php echo $errpublpath; ?></span></td>
</tr>
	

<tr>
<div id="journal">
<td><label class="label">Journal Name </label></td>
<td><input type = "text" class="text" name="journalname[]" placeholder="Enter the JournalName"/>
<span style="color:red">* <?php echo $errjname; ?></span>
</td>
	</div>
<td><input type="button" id="addjournal" value="Add another Journal" >
	</td>
	</tr>
	</table>
<!--
<tr>
<td><label class="label">Article Name </label></td>
<td><input type = "text" class="text" name="txtarticlename" placeholder="Enter the Article Name"/>
<span style="color:red">* <?php echo $errarticlename; ?></span></td>
</tr>
!-->

	<table style="margin-top:-45px;margin-left:65px;" cellspacing="42px">
<tr>
	<td><input type ="submit" value="Submit" name="submit" class="button" /></td>
<td><input type ="reset" value="Cancel" name="cancel" class="button" /></td>
</tr>

</table>

</form>

</div>

<?php

?>
</body>
</html>