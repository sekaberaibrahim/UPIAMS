<?php
// Fetch devices from the database
session_start();

if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}
 $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'Atte';

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
$query = "SELECT * FROM devices";
$stmt = $dbh->prepare($query);
$stmt->execute();
$devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices | Attendance</title>
 <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen">
<?php include"./includes/header.php" ?>
<div class="w-10/12  my-12  mx-auto items-center justify-center  bg-white p-6 rounded-md shadow-md">
    <h1 class="text-2xl  font-semibold mb-4">Device Management</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Device ID</th>
                <th class="px-4 py-2">Device Name</th>
                <th class="px-4 py-2">Location</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device) : ?>
                <tr class="text-center">
                    <td class="border px-4 py-2"><?php echo $device['device_id']; ?></td>
                    <td class="border px-4 py-2"><?php echo $device['device_name']; ?></td>
                    <td class="border px-4 py-2"><?php echo $device['location']; ?></td>
                    <td class="border px-4 py-2">
                        <button class="bg-blue-500 text-white px-2 py-1 rounded-md" 
                                data-device-id="<?php echo $device['device_id']; ?>"
                                data-mode="<?php echo $device['mode']; ?>">
                            <?php echo ucfirst($device['mode']); ?>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    const toggleButtons = document.querySelectorAll('[data-device-id]');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const deviceId = this.getAttribute('data-device-id');
            const currentMode = this.getAttribute('data-mode');
            const newMode = currentMode === 'attendance' ? 'register' : 'attendance';

            const confirmMessage = `Are you sure you want to change the mode of Device ${deviceId} to ${newMode}?`;
            if (confirm(confirmMessage)) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_device_mode.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
                        button.textContent = newMode.charAt(0).toUpperCase() + newMode.slice(1);
                        button.setAttribute('data-mode', newMode);
                    }
                };
                xhr.send(`device_id=${deviceId}&mode=${newMode}`);
            }
        });
    });
</script>

</body>
</html>
