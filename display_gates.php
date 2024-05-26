<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jerusalem_gates";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM gates";
$result = $conn->query($sql);

$gates = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $gates[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $gates]);
} else {
    echo json_encode(["status" => "success", "data" => []]);
}

$conn->close();
?>
