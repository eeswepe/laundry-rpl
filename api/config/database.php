<?php
$host = 'sql12.freesqldatabase.com';
$db = 'sql12750969';
$user = 'sql12750969';
$pass = 'qF56BPdCHt';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
