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

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {

        $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $stmt = $dbh->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        header("location: manage_users.php");
        exit();
    } catch (PDOException $e) {
        die("Database Error: Unable to delete user.");
    }
} else {
    die("User ID not provided.");
}
?>