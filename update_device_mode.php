<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'Atte';


    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

    $deviceId = $_POST['device_id'];
    $newMode = $_POST['mode'];
    echo ($deviceId);
    echo ($newMode);


    $query = "UPDATE devices SET mode = :mode WHERE device_id = :device_id";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':mode', $newMode);
    $stmt->bindParam(':device_id', $deviceId);

    if ($stmt->execute()) {
        echo "Device mode updated successfully to $newMode";
    } else {
        echo "Error updating device mode";
    }
} else {
    echo "Invalid request";
}
?>