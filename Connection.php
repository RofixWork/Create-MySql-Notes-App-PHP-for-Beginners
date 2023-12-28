<?php
namespace app;
class Connection
{
    private ?\PDO $pdo;
    public function __construct()
    {
        $pdo = new \PDO("mysql:server=localhost;dbname=notes", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    public function getNotes() : array|bool{
        $query = /** @lang text */
            "SELECT * FROM notes ORDER BY created_date DESC";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(mode: \PDO::FETCH_ASSOC);
    }

    public function createNote($note) : bool{
        $query = /** @lang text */
            "INSERT INTO notes(id, title, description) VALUES (:id, :title, :desc)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("id", rand(1, 10000), \PDO::PARAM_INT);
        $statement->bindValue("title",  $note["title"]);
        $statement->bindValue("desc", $note["desc"]);
        return $statement->execute();
    }

    public function getNoteBy(int $id) {
        $query = /**@lang text */ "SELECT * FROM notes WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("id", $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateNote(int $id, $data) : void{
        $query = /**
         * @lang text
         */
        "UPDATE notes SET title=:title, description=:desc WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("id", $id, \PDO::PARAM_INT);
        $statement->bindValue("title", $data["title"]);
        $statement->bindValue("desc", $data["description"]);
        $statement->execute();
    }

    public function deleteNote(int $id)  : void {
        $query = /**
         * @lang text
         */
            "DELETE FROM notes WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("id", $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function close() : void{
        $this->pdo = null;
    }
}