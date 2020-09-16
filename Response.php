<?php
//database connection file
require_once 'connect.php';

if(isset($_POST['get_option'])) {
    $room_number = $_POST['get_option'];
    $query = $conn->query("select room_number from room_number where room_name ='$room_number'");
    while ($row = $query->fetch()) {
        echo "<option>" . $row['room_number'] . "</option>";
    }
    exit;
}