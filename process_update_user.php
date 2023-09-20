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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        $email = $_POST['email'];
        $username = $_POST['username'];
        try {
            $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

            $stmt = $dbh->prepare("UPDATE users SET email = :email, username = :username WHERE user_id = :user_id");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':user_id', $user_id);

            $stmt->execute();

            header("location: manage_users.php");
            exit();
        } catch (PDOException $e) {

            die("Database Error: Unable to update user data.");
        }
    } else {
        die("User ID not provided.");
    }
} else {
    header("location: update_user.php");
    exit();
}
?>