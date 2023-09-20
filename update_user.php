<?php

session_start();


if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}


$db_host = 'localhost';
$db_name = 'atte';
$db_user = 'root';
$db_pass = '';

try {
   
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $stmt = $dbh->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("User not found.");
        }
    } else {
        die("User ID not provided.");
    }
} catch (PDOException $e) {
    die("Database Error: Unable to fetch user data.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="container border py-12 shadow-2xl w-7/12 mx-auto">
        <h1 class="text-4xl text-center font-bold my-4">Update User</h1>
        <form class="mx-auto max-w-lg" action="process_update_user.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="email">Email</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="email" name="email" type="email" placeholder="Email" value="<?php echo $user['email']; ?>">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="username">Name</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="username" name="username" type="text" placeholder="Name" value="<?php echo $user['username']; ?>">
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Update User
                </button>
            </div>
        </form>
    </div>
</body>

</html>
