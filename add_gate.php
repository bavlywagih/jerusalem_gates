<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jerusalem_gates";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $historical_significance = $_POST["historical_significance"];
    $image_url = $_POST["image_url"];

    $sql = "INSERT INTO gates (name, description, historical_significance, image_url)
    VALUES ('$name', '$description', '$historical_significance', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "New gate added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

$conn->close();
?>
