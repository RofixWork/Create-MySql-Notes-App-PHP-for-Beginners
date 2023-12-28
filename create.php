<?php
require_once __DIR__ . '/vendor/autoload.php';
use app\Connection;
echo "<pre>";
var_dump($_POST);
try {
    $pdo = new Connection();
    if(empty(trim($_POST["title"])) || empty(trim($_POST["desc"]))) {
        throw new Exception("Please Fill Data");
    }
    $pdo->createNote($_POST);
}catch(PDOException|Exception $ex) {
    echo "Connection failed: " . $ex->getMessage();
} finally {
    if (!empty($pdo)) {
        $pdo->close();
    }
    header("Location: index.php");
}

echo "</pre>";
