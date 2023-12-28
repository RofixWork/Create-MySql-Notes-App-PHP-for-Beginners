<?php
require_once __DIR__ . '/vendor/autoload.php';
use \app\Connection;
$notes = [];
try {
    $pdo = new Connection();
    $notes = $pdo->getNotes();
}catch(PDOException $ex) {
    echo "Connection failed: " . $ex->getMessage();
}
$currentNote = [
    "id" => "",
    "title" => "",
    "desc" => ""
];
//get note
$id = $_GET["id"] ?? null;
if($id) {
    try {
        $pdo = new Connection();

        $note = $pdo->getNoteBy($id) ?? null;

        if(!$note) {
            throw new Exception("not exist any note by this id");
        }
        var_dump($note);
        $currentNote["title"] = $note["title"];
        $currentNote["id"] = $note["id"];
        $currentNote["desc"] = $note["description"];

    }catch(PDOException|Exception $ex) {
        echo "Connection failed: " . $ex->getMessage();
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mysql Notes</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: monospace;
        width: 80%;
        margin: 30px auto;
    }
    input, button, textarea
    {
        font-family: monospace;
        width: 100%;
        display: block;
        margin: 10px 0;
        padding: 10px 5px;
    }
    li {
        background-color: black;
        color: white;
        width: 100%;
        list-style: none;padding: 30px 20px;margin: 10px 0;
        font-size: 20px;
    }
    a {
        display:  inline-block;
        background-color: red;
        color: white;
        padding: 10px;
        text-decoration: none;
    }

</style>
<body>
    <form method="post" action="<?= empty($currentNote["title"]) ?  "create.php" : "update.php?id=" . $currentNote["id"]?>">
        <input type="text" name="title" placeholder="enter title here" value="<?php echo empty($currentNote["title"]) ? "" : $currentNote["title"] ?>" >
        <textarea name="desc" rows="10" ><?php echo empty($currentNote["desc"]) ? "" : $currentNote["desc"] ?></textarea>
        <button type="submit">
            <?= empty($currentNote["title"]) ?  "Create" : "update"?>
        </button>
    </form>
    <?php if(count($notes)) {?>
    <ul>
        <?php foreach ($notes as $note) :?>
            <li>
                <h3><?= $note["title"] ?></h3>
                <p><?= $note["description"] ?></p>
                <h4><?= date_format(date_create($note["created_date"]), "d/m/y H:i") ?></h4>
                <a href="index.php?id=<?= $note["id"] ?>">Update</a>
                <a href="delete.php?id=<?= $note["id"] ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php } else { ?>
        <h2>No Notes</h2>
    <?php } ?>
</body>
</html>
