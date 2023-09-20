<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
  <nav class="md:flex items-center py-2 px-6 bg-slate-800 text-white justify-between">
    <div class="flex justify-between">
        <div class="text-3xl">
        ULK POLYTECHNIC INSTITUTE
    </div>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuButton" class="md:hidden">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>
    </div>

    <ul id="menuItems" class="hidden md:flex text-center space-y-4 md:space-y-0 justify-center md:justify-between capitalize gap-x-6 items-center">
        <?php
        if (isset($_SESSION['user_email'])) {
            echo '<li><a href="dashboard.php">dashboard</a></li>';
            echo '<li><a href="attendanceTable.php">Attendance</a></li>';
            echo '<li><a href="manage_users.php">manage users</a></li>';
            echo '<li><a href="devices.php">devices</a></li>';
            echo '<li><a href="logout.php">logout</a></li>';
        } else {
            echo '<li><a href="index.php">home</a></li>';
            echo '<li><a href="about.php">about</a></li>';
            echo '<li><a href="login.php">login</a></li>';
        }
        ?>
    </ul>
</nav>


    <?php
    
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'Atte';

   
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

   
    // $queryUsers = "SELECT COUNT(*) as total_users FROM users";
    // $stmtUsers = $dbh->prepare($queryUsers);
    // $stmtUsers->execute();
    // $totalUsers = $stmtUsers->fetch(PDO::FETCH_ASSOC)['total_users'];

   
    // $queryDepartments = "SELECT COUNT(*) as total_departments FROM departments";
    // $stmtDepartments = $dbh->prepare($queryDepartments);
    // $stmtDepartments->execute();
    // $totalDepartments = $stmtDepartments->fetch(PDO::FETCH_ASSOC)['total_departments'];

    
    // $queryPresentToday = "SELECT COUNT(*) as present_today FROM attendance WHERE day = CURDATE()";
    // $stmtPresentToday = $dbh->prepare($queryPresentToday);
    // $stmtPresentToday->execute();
    // $presentToday = $stmtPresentToday->fetch(PDO::FETCH_ASSOC)['present_today'];

    // $absentToday = $totalUsers - $presentToday;
    $queryUsers = "SELECT COUNT(*) as total_users FROM users";
$stmtUsers = $dbh->prepare($queryUsers);
$stmtUsers->execute();
$totalUsers = $stmtUsers->fetch(PDO::FETCH_ASSOC)['total_users'];


$queryDepartments = "SELECT COUNT(*) as total_departments FROM departments";
$stmtDepartments = $dbh->prepare($queryDepartments);
$stmtDepartments->execute();
$totalDepartments = $stmtDepartments->fetch(PDO::FETCH_ASSOC)['total_departments'];


$queryPresentToday = "SELECT COUNT(*) as present_today FROM attendance WHERE day = CURDATE()";
$stmtPresentToday = $dbh->prepare($queryPresentToday);
$stmtPresentToday->execute();
$presentToday = $stmtPresentToday->fetch(PDO::FETCH_ASSOC)['present_today'];
 $queryChartData = "SELECT a.day, u.total_users, COUNT(a.user_id) AS present_users
FROM (
    SELECT DISTINCT day, user_id
    FROM attendance
) a
JOIN (
    SELECT COUNT(*) AS total_users
    FROM users
) u
ON 1 = 1
GROUP BY a.day, u.total_users
ORDER BY a.day;";
$stmtChartData = $dbh->prepare($queryChartData);
$stmtChartData->execute();
$chartData = $stmtChartData->fetchAll(PDO::FETCH_ASSOC);

  $absentUsers = array_map(function ($entry) {
    return $entry['total_users'] - $entry['present_users'];
}, $chartData);


    ?>
 <div class="w-11/12 mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
         
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-xl font-semibold mb-2">Total Users</h2>
                <p class="text-3xl font-bold"><?php echo $totalUsers; ?></p>
            </div>
            
            
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-xl font-semibold mb-2">Total Departments</h2>
                <p class="text-3xl font-bold"><?php echo $totalDepartments; ?></p>
            </div>
            
           
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-xl font-semibold mb-2">Present Today</h2>
                <p class="text-3xl font-bold"><?php echo $presentToday; ?></p>
            </div>
            
          
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-xl font-semibold mb-2">Absent Today</h2>
                <p class="text-3xl font-bold"><?php echo $totalUsers - $presentToday; ?></p>
            </div>
        </div>
         <div class="bg-white h-screen p-4 rounded-md shadow-md mt-8">
        <h2 class="text-xl font-semibold mb-4">User Trends</h2>
        <canvas id="lineChart"></canvas>
    </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const mobileMenuButton = document.getElementById("mobileMenuButton");
        const menuItems = document.getElementById("menuItems");

        mobileMenuButton.addEventListener("click", function() {
            menuItems.classList.toggle("hidden");
        });
    });
  
         const ctx = document.getElementById('lineChart').getContext('2d');

   
    const data = {
        labels: <?php echo json_encode(array_column($chartData, 'day')); ?>,
        datasets: [
            {
                label: 'Present Users',
                data: <?php echo json_encode(array_column($chartData, 'present_users')); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true
            },
            {
                label: 'Absent Users',
                data: <?php echo json_encode($absentUsers); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: true
            }
        ]
    };

   
    const options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

   
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });
</script>

</body>
</html>

