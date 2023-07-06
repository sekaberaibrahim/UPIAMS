<?php
	session_start();
	require 'config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admin Dashboard | Homepage</title>
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
                        <a href="" class="active">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="las la-user-alt"></span>
                            <small>Student</small>
                        </a>
                    </li>
                    <li>
                        <a href="departments">
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
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>

            <div class="page-content">

                <div class="analytics">

                    <div class="card">
                        <div class="card-head">
                            <h2>824</h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total Student</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-head">
                            <h2>5</h2>
                            <span class=" las la-school"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total Departments</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>15</h2>
                            <span class="las la-university"></span>
                        </div>
                        <div class="card-progress">
                            <small>Classes</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                </div>


          

                

            </div>

        </main>

    </div>
</body>

</html>