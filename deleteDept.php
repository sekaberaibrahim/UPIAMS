<?php 
session_start();
include("config.php");
$id=$_GET['id'];
mysqli_query($con,"delete from department where id='$id'");
header("Location:departments.php");
?>