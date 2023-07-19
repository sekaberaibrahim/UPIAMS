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
}
else
{
    mysql->error;
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upi</title>
    <link rel="stylesheet" href="style11.css">
  <style type="text/css">

  </style>
</head>
<body>
<?php 
$id1=$_GET['id'];
 $qry="select * from student where id='$id1'";
 $q=mysqli_query($con,$qry);
 $row=mysqli_fetch_array($q);
?>
    <main>
      <section id="popup" class="form">
      <div class="popup-content">

        <form class="form-container" action="" method="post">
          <input type="hidden"  name="id" required value="<?php echo $id1;?>">
    <label for="fname">RollNumber</label><br>
    <input type="number" id="fname" name="rollno" required value="<?php echo $row['RollNumber'];?>"><br>

    <label for="lname">Names</label><br>
    <input type="text" id="lname" name="names" required value="<?php echo $row['Names'];?>"><br>

    <label for="gender">Email: </label>
    <input type="email" id="lname" name="email" required value="<?php echo $row['Email'];?>"><br>
    <br><br>
    <label for="gender">Telephone: </label>
    <input type="text" id="lname" name="phone" required value="<?php echo $row['Telephone'];?>"><br>
    <br><br>

    <label for="dob">Date of Birth: </label>
    <input type="date" id="dob" name="dob" required value="<?php echo $row['Dob'];?>"><br><br>

    <label for="email">Gender</label><br>
    <input type="email" id="email" name="gender" required value="<?php echo $row['Gender'];?>">

    <label for="dob">Department: </label>
    <input type="text" id="dob" name="dpt" required value="<?php echo $row['Dept'];?>"><br><br>

    <label for="dob">Nationality: </label>
    <input type="text" id="dob" name="nationality" required value="<?php echo $row['Nationality'];?>"><br><br>

    <input type="submit" value="Submit" name="update">
  </form>

      </div>
    </section>
    </main>

    <footer>
        <p>Pharmacy Management System &copy; 2023</p>
    </footer>
</body>
</html>