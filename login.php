<?php
session_start();

if (isset($_SESSION['user_email'])) {
    header("location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include('includes/header.php') ?>

    <form class="grid rounded-md shadow-lg p-6 my-12 w-6/12 mx-auto" action="includes/login.inc.php" method="post">
        <h1 class="my-4 font-bold text-4xl">Login Page</h1>
        <hr>
        <div class="grid gap-1 my-2">
            <label class="text-xl" for="email">Email</label>
            <input class="border rounded-md p-2" type="email" name="email" id="email">
        </div>
        <div class="grid gap-1 my-2">
            <label class="text-xl" for="password">Password</label>
            <input class="border rounded-md p-2" type="password" name="password" id="password">
        </div>
        <div>
            <input class="border hover:bg-slate-800 cursor-pointer hover:text-white p-2 px-6 font-medium rounded-md"
                type="submit" value="Login" name="submit">
        </div>
        <?php
        if (isset($_GET['errors'])) {
            $errorMessages = explode(',', $_GET['errors']);
            foreach ($errorMessages as $error) {
                echo '<p class="text-center py-2 text-sky-500">' . htmlspecialchars($error) . '</p>';
            }
        }
        ?>

    </form>

</body>

</html>