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

    $note["title"] = $_POST["title"] ?? $note["title"];
    $note["description"] = $_POST["description"] ?? $note["description"];
    $pdo->updateNote($note["id"], $note);
}catch(PDOException|Exception $ex) {
    echo "Connection failed: " . $ex->getMessage();
} finally {
    if (!empty($pdo)) {
        $pdo->close();
    }
    header("Location: index.php");
}