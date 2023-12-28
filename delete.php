<?php
require_once __DIR__ . '/vendor/autoload.php';
use app\Connection;
echo "<pre>";

try {
    $pdo = new Connection();

    $id = $_GET["id"] ?? null;
    if(!$id) {
        throw new Exception("Invalid URL Params");
    }

    $note = $pdo->getNoteBy($id) ?? null;
    if(!$note) {
        throw new Exception("not exist this note");
    }

    $pdo->deleteNote($note["id"]);
}catch(PDOException|Exception $ex) {
    echo "Connection failed: " . $ex->getMessage();
} finally {
    if (!empty($pdo)) {
        $pdo->close();
    }
    header("Location: index.php");
}
