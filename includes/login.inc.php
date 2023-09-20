<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once 'functions.inc.php';

    $errors = array();

    
    if (empty($email) || empty($password)) {
        $errors[] = 'Fill All Fields';
    }

    

    if (count($errors) === 0) {
       
        $login_result = loginUser($email, $password);

        if ($login_result === "success") {
           
            header("location: ../dashboard.php");
            exit();
        } elseif ($login_result === "wrongpassword") {
            
            $errors[] = 'Invalid Password';
        } elseif ($login_result === "usernotfound") {
         
            $errors[] = 'User not found';
        } else {
           
            $errors[] = 'Unknown Error';
        }
    }

    
    header("location: ../login.php?errors=" . urlencode(implode(',', $errors)));
    exit();
} else {
    header("location: ../login.php");
    exit();
}
?>
