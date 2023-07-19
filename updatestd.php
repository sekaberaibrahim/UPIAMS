<?php  
include("config.php");
if(isset($_POST['update'])){
$RollNumber=$_POST['rollno'];
$names=$_POST['names'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$dept=$_POST['dept'];
$nationality=$_POST['nationality'];
$qry="UPDATE `student` SET `RollNumber`=$RollNumber,`Names`=$names,`Email`=$email,`Telephone`=$phone,`Dob`=$dob,`Gender`=$gender,`Dept`=$dept,`Nationality`='$nationality where id='$_POST[id]'";
$sql=mysqli_query($con,$qry);
if ($sql) {
header("Location:students.php");
}}

?>