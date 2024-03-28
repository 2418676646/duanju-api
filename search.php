<?php
// 设置数据库连接变量
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// 创建连接
$conn = new mysqli($servername, $username, $password);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 创建数据库
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");

// 选择数据库
$conn->select_db($dbname);

// 创建表
$conn->query("CREATE TABLE IF NOT EXISTS short_plays (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
play_name VARCHAR(30) NOT NULL,
play_url VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

// 检查前端传递的参数
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['text'])) {
    $text = $_GET['text'];

    // 防止SQL注入
    $text = mysqli_real_escape_string($conn, $text);

    // SQL查询语句
    $sql = "SELECT play_name, play_url FROM short_plays WHERE play_name LIKE '%$text%'";
    $result = $conn->query($sql);

    // 检查结果
    if ($result->num_rows > 0) {
        $plays = array();
        // 输出数据
        while($row = $result->fetch_assoc()) {
            array_push($plays, $row);
        }
        header('Content-Type: application/json');
        echo json_encode($plays);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("message" => "没有找到剧目"));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array("message" => "无效请求"));
}

// 关闭连接
$conn->close();
?>
