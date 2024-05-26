// create_table.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jerusalem_gates";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إنشاء قاعدة البيانات إذا لم تكن موجودة
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// استخدام قاعدة البيانات
$conn->select_db($dbname);

// إنشاء جدول الأبواب
$sql = "CREATE TABLE IF NOT EXISTS gates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    historical_significance TEXT,
    image_url VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table gates created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
