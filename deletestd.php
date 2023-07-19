<?php 
session_start();
include("config.php");
$id=$_GET['id'];
mysqli_query($con,"delete from student where id='$id'");
header("Location:students.php");
?>