<?php
    require 'config.php';
?>
 <?php 
            if(isset($_POST['register'])){
            $roll=$_POST['rollno'];
            $names=$_POST['names'];
            $email=$_POST['email'];
            $phone=$_POST['phone'];
            $dob=$_POST['dob'];
            $gender=$_POST['gender'];
            $dept=$_POST['dept'];
            $nationality=$_POST['nationality'];
            $qry="INSERT INTO `student`(`RollNumber`, `Names`, `Email`, `Telephone`, `Dob`, `Gender`, `Dept`, `Nationality`) VALUES ('$roll','$names','$email','$phone','$dob','$gender','$dept','$nationality')";
            $sql=mysqli_query($con,$qry);
            if($sql){

            header("location:students.php");

            }
            else {
              echo"Error".$sql.$con->error;
            }
            }
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Department Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="logstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        

        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/1.png)"></div>
                <h4>ULK</h4>
                <small>Polytechnic  Institute

                </small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                        <a href="homepage.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="students.php" class="active">
                            <span class="las la-user-alt"></span>
                            <small>Student</small>
                        </a>
                    </li>
                    <li>
                        <a href="departments.php">
                            <span class="las la-school""></span>
                            <small>Departments</small>
                        </a>
                    </li>
                    <li>
                        <a href="adduser.php">
                            <span class="las la-clipboard-list"></span>
                            <small>Reports</small>
                        </a>
                    </li>
                    <li>
                        <a href="user">
                            <span class=" las la-users-cog"></span>
                            <small>Admin</small>
                        </a>
                    </li>
                 

                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <label for="">
                      <span class="las la-search"></span>
                        
                    </label>



                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/3.jpg)"></div>

                        <span class="las la-power-off"></span>
                        <span> <a href="logout"> Logout</a></span>
                    </div>
                </div>
            </div>
        </header>


        <main>

            <div class="page-header">
                <h1>MANAGE STUDENT PAGE</h1>
                <small><a href="addStd.php"><button class="btn btn-primary">ADD NEW STUDENT</button></a></small>
            </div>

            <div class="page-content">

                <div class="analytics">
                 <div class="wrapper"  style="margin-left:390px;margin-top: 250px;">
        <header>UPI A.M.S </header>
        <form class="myform" action="" method="post">
            <h3>Register Student</h3>
            <div class="field email">
                <div class="input-area">
                    <input name="rollno" type="number" class="inputvalues" placeholder="Enter The Roll Number" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Roll Number can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="names" type="text" class="inputvalues" placeholder="Enter The Names" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Names can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="email" type="email" class="inputvalues" placeholder="Enter The Email" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Email can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="phone" type="number" class="inputvalues" placeholder="Enter Telephone Number" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Telephone Number can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="dob" type="date" class="inputvalues" placeholder="Enter Date of Birth" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Roll Number can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="gender" type="text" class="inputvalues" placeholder="Enter The Gender" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Gender can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="dept" type="text" class="inputvalues" placeholder="Enter The Department" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Department can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="nationality" type="text" class="inputvalues" placeholder="Enter The Nationality" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Nationality can't be blank</div>
            </div>
            <input name="register" type="submit" id="login_btn" value="Register">
        </form>



    </div>

    <script src="script/homescript.js"></script>
   



                    

                   

                </div>


          

                

            </div>

        </main>

    </div>
</body>

</html>