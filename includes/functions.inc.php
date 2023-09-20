<?php



function loginUser($email, $password) {
    
    $db_host = 'localhost';
    $db_name = 'Atte';
    $db_user = 'root';
    $db_pass = '';

    try {
        
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

        
        $stmt = $dbh->prepare("SELECT email, password FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if (!$user) {
            return 'usernotfound';
        }

        
        if ($password == $user['password']) {
           session_start();
            $_SESSION['user_email'] = $user['email'];
            return 'success';
        } else {
            
            return 'wrongpassword';
        }
    } catch (PDOException $e) {
        
        
        
        return 'error';
    }
}
function addUser($card, $username, $email, $gender, $department, $class, $dob) {
    $db_host = 'localhost';
    $db_name = 'Atte';
    $db_user = 'root';
    $db_pass = '';

    try {
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

       
        $stmt = $dbh->prepare("INSERT INTO users (card, username, email, gender, department_id, class_id, dob, status) 
                      VALUES (:card, :username, :email, :gender, :department, :class, :dob, :status)");
$stmt->bindParam(':card', $card);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':department', $department);
$stmt->bindParam(':class', $class);
$stmt->bindParam(':dob', $dob);
$stmt->bindValue(':status', 'active');
$stmt->execute();

        return 'success';
    } catch (PDOException $e) {
        return 'error';
    }
}
?>
