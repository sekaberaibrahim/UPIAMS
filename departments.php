<?php
	session_start();
	require 'config.php';
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
                        <a href="students.php">
                            <span class="las la-user-alt"></span>
                            <small>Student</small>
                        </a>
                    </li>
                    <li>
                        <a href="departments.php" class="active">
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
                <h1>MANAGE DEPARTMENTS PAGE</h1>
                <small><a href="addDept.php"><button class="btn btn-primary">ADD NEW DEPARTMENTS</button></a></small>
            </div>

            <div class="page-content">

                <div class="analytics">
                    <div class="card-body">
                                    <div class="chart-area">
                                    
                                        


                                        
                                            <table class="table" style="margin-left: 200px;">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>DEPARTMENT NAME</th>
                                                    <th>SCHOOL</th>
                                                    <th colspan="2">DESICION</th>
                                                        <?php 
                                        
                                        

                                        $select="SELECT * FROM department ";
                                        $select_query=mysqli_query($con,$select);
                                            while ($row = mysqli_fetch_array($select_query)) {
                                                echo"<tr>";
                                                echo "<td>".$row['id']."</td>";
                                                echo "<td>".$row['name']."</td>";
                                                echo "<td>".$row['school']."</td>";
                                                echo "<td><a href='delete.php?id=".$row["id"]."'>Delete</a></td>";
                                                echo "<td><a href='update.php?id =" .$row["id"]."'>Update</a></td>";

                                                }
                                                ?>
                                            </table>


                                    </div>
                                </div>
                   



                    

                   

                </div>


          

                

            </div>

        </main>

    </div>
</body>

</html>