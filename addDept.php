<?php
    require 'config.php';
?>
 <?php 
            if(isset($_POST['add'])){
            $names=$_POST['name'];
            $school=$_POST['school'];
            $qry="INSERT INTO `department`(`name`, `school`) VALUES ('$names','$school')";
            $sql=mysqli_query($con,$qry);
            if($sql){

            header("Location: /departments.php");

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

            <div class="page-content">

                <div class="analytics">
                 <div class="wrapper"  style="margin-left:390px;margin-top: 50px;">
        <header>UPI A.M.S </header>
        <form class="myform" action="" method="post">
            <h3>ADD NEW DEPARTMENT</h3>
             <div class="field email">
                <div class="input-area">
                    <input name="name" type="text" class="inputvalues" placeholder="Enter The Names" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Names can't be blank</div>
            </div>
             <div class="field email">
                <div class="input-area">
                    <input name="school" type="text" class="inputvalues" placeholder="Enter The School" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">School can't be blank</div>
            </div>
            <input name="add" type="submit" id="login_btn" value="Add">
        </form>


       


    </div>

   



                    

                   

                </div>


          

                

            </div>

        </main>

    </div>
</body>

</html>