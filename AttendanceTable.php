<?php session_start();

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
    <title>Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
     <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
         <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

</head>

<body>
    <?php include('includes/header.php') ?>

    <div class="w-11/12 mx-auto mt-8">
        <h1 class="text-4xl font-bold mb-4">Attendance Table</h1>
        <div class="overflow-x-auto">
            <table id="attendanceTable" class="w-full mx-auto border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="border p-2">Attendance ID</th>
                        <th class="border p-2">Username</th>
                        <th class="border p-2">Department Name</th>
                        <th class="border p-2">Class Name</th>
                        <th class="border p-2">Time In</th>
                        <th class="border p-2">Time Out</th>
                        <th class="border p-2">Day</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $db_host = 'localhost';
                    $db_username = 'root';
                    $db_password = '';
                    $db_name = 'Atte';

                    
                    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

                    
                    $query = "SELECT a.*, u.username, d.department_name, c.class_name
                              FROM attendance a
                              JOIN users u ON a.user_id = u.user_id
                              LEFT JOIN departments d ON u.department_id = d.department_id
                              LEFT JOIN classes c ON u.class_id = c.class_id";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();

                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr class="hover:bg-slate-100">';
                        echo '<td class="border p-2">' . $row['attendance_id'] . '</td>';
                        echo '<td class="border p-2">' . $row['username'] . '</td>';
                        echo '<td class="border p-2">' . $row['department_name'] . '</td>';
                        echo '<td class="border p-2">' . $row['class_name'] . '</td>';
                        echo '<td class="border p-2">' . $row['time_in'] . '</td>';
                        echo '<td class="border p-2">' . $row['time_out'] . '</td>';
                        echo '<td class="border p-2">' . $row['day'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable({
            dom: 'Bfrtip', 
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
</html>
