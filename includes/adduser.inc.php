<?php

if (isset($_POST['submit'])) {
    $card = $_POST['card'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $class = $_POST['class'];
    $dob = $_POST['dob'];
    echo "<script>alert($card, $username, $email, $gender, $department, $class)</script>";

    require_once 'functions.inc.php';

    $errors = array();


    if (empty($card) || empty($username) || empty($email) || empty($gender) || empty($department) || empty($class) || empty($dob)) {
        $errors[] = 'Fill All Fields';
    }



    if (count($errors) === 0) {

        $add_user_result = addUser($card, $username, $email, $gender, $department, $class, $dob);

        if ($add_user_result === "success") {

            header("location: ../manage_users.php");
            exit();
        } else {

            $errors[] = 'Unknown Error';
        }
    }


    header("location: ../adduser.php?errors=" . urlencode(implode(',', $errors)));
    exit();
} else {
    header("location: ../adduser.php");
    exit();
}
?>