<?php

session_start();


if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}


$db_host = 'localhost';
$db_name = 'Atte';
$db_user = 'root';
$db_pass = '';

try {

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);


    $stmt = $dbh->prepare("SELECT u.*, d.department_name, c.class_name
                          FROM users u
                          JOIN departments d ON u.department_id = d.department_id
                          JOIN classes c ON u.class_id = c.class_id");
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Database Error: Unable to fetch users.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="container w-11/12 mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold my-4">Manage Users</h1>
            <a class="border px-4 py-2 rounded-md bg-slate-900 text-white" href="AddUser.php">Add User</a>
        </div>
        <div class="mb-4">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">Search
                Users:</label>
            <input placeholder="seach ..." id="search" type="text"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Card</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Department</th>
                        <th class="px-4 py-2">Class</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="border px-4 py-2">
                                <?php echo $user['user_id']; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <?php echo $user['card']; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <?php echo $user['email']; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <?php echo $user['username']; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <?php echo $user['department_name']; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <?php echo $user['class_name']; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="update_user.php?user_id=<?php echo $user['user_id']; ?>"
                                    class="text-blue-600 hover:underline">Update</a>
                                <a href="delete_user.php?user_id=<?php echo $user['user_id']; ?>"
                                    class="text-red-600 hover:underline ml-2">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
    const searchInput = document.getElementById('search');
    const userTableBody = document.getElementById('userTableBody');

    searchInput.addEventListener('input', function () {
        const query = searchInput.value.trim();
        if (query === '') {

            userTableBody.innerHTML = '';
            <?php foreach ($users as $user): ?>
                userTableBody.innerHTML += `
                            <tr>
                                <td class="border px-4 py-2"><?php echo $user['user_id']; ?></td>
                                <td class="border px-4 py-2"><?php echo $user['card']; ?></td>
                                <td class="border px-4 py-2"><?php echo $user['email']; ?></td>
                                <td class="border px-4 py-2"><?php echo $user['username']; ?></td>
                                <td class="border px-4 py-2"><?php echo $user['department_name']; ?></td>
                                <td class="border px-4 py-2"><?php echo $user['class_name']; ?></td>
                                <td class="border px-4 py-2">
                                    <a href="update_user.php?user_id=<?php echo $user['user_id']; ?>"
                                        class="text-blue-600 hover:underline">Update</a>
                                    <a href="delete_user.php?user_id=<?php echo $user['user_id']; ?>"
                                        class="text-red-600 hover:underline ml-2">Delete</a>
                                </td>
                            </tr>
                        `;
            <?php endforeach; ?>
        } else {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    userTableBody.innerHTML = this.responseText;
                }
            };
            xhttp.open('GET', `search_users.php?query=${encodeURIComponent(query)}`, true);
            xhttp.send();
        }
    });
</script>

</html>