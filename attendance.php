<?php

require "./includes/db.inc.php";

function uuid()
{
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$uuid4 = uuid();
if (isset($_POST['card'])) {

    $card = $_POST['card'];
    $deviceID = $_POST['device_id'];




    $query = "SELECT mode FROM devices WHERE device_id = '$deviceID'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $deviceMode = $row['mode'];

            if ($deviceMode == 'attendance') {

                $query = "SELECT * FROM users WHERE card = '$card' AND status = 'active'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $userID = $row['user_id'];
                        $userDepartment = $row['department_id'];
                        $userClass = $row['class_id'];


                        $today = date('Y-m-d');
                        $query = "SELECT attendance_id, time_in, time_out FROM attendance WHERE user_id = '$userID' AND day = '$today'";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {

                                $row = mysqli_fetch_assoc($result);
                                $timeIn = $row['time_in'];
                                $timeOut = $row['time_out'];

                                if ($timeIn !== null && $timeOut !== null && $timeOut != '00:00:00') {

                                    echo "Attendance already taken for today. Please wait for the next day.";
                                } else {

                                    $currentTime = time();
                                    $timeInTimestamp = strtotime($timeIn);
                                    $timeDifference = $currentTime - $timeInTimestamp;

                                    if ($timeDifference >= 600) {

                                        $timeOut = date('Y-m-d H:i:s');
                                        $attendanceID = $row['attendance_id'];
                                        $query = "UPDATE attendance SET time_out = '$timeOut' WHERE attendance_id = '$attendanceID'";
                                        mysqli_query($conn, $query);


                                        echo "Attendance recorded successfully. Time out: $timeOut";
                                    } else {

                                        $remainingTime = 600 - $timeDifference;
                                        echo "Please wait for at least 10 minutes before making time_out. Remaining time: $remainingTime seconds.";
                                    }
                                }
                            } else {

                                $timeIn = date('Y-m-d H:i:s');
                                $query = "INSERT INTO attendance (user_id, device_id,department_id,class_id, time_in,day) VALUES ('$userID', '$deviceID','$userDepartment','$userClass', '$timeIn', '$today')";
                                mysqli_query($conn, $query);


                                echo "Attendance recorded successfully. Time in: $timeIn";
                            }
                        } else {

                            echo "Error: " . mysqli_error($conn);
                        }
                    } else {

                        echo "Invalid user or user inactive.";
                    }
                } else {

                    echo "Error: " . mysqli_error($conn);
                }
            } else {

                echo "<script>document.getElementById('card').value = '$card';</script>";
                echo "Device mode is not set to 'attendance'.";
                $write = "<?php \$card = '$card'; echo \$card; ?>";
                file_put_contents('UIDContainer.php', $write);
            }
        } else {

            echo "Invalid device ID.";
        }
    } else {

        echo "Error: " . mysqli_error($conn);
    }
} else {
    die("No card id or device id received");
}