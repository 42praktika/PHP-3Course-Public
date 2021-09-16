<?php


class UriDB
{
    private string $connString;
    private PDO $pdo;
    public function __construct($host, $port, $dbname, $user, $password)
    {
       $this->connString = sprintf(
           "pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s",
           $host,
           $port,
           $dbname,
           $user,
           $password
       );
       $this->pdo = new PDO($this->connString);

    }

    public function Query(string $statement, int $mode) {
        return $this->pdo->query($statement, $mode);
    }

    public function QueryUris(string  $statement) {
        $q= $this->Query($statement, PDO::FETCH_ASSOC);
        if ($q==false)  return [];
        foreach ($q->fetchAll() as $item) {
            $result[] = new Uri($item["uri"], $item["id"], $item["parent_id"]);
        }

        return $result;
    }

    public function GetAllUris() {
       return $this->QueryUris("SELECT * FROM uris");
    }

    public function QueryById(int $id): array {
        $q= $this->Query("select * from uris where parent_id=".$id, PDO::FETCH_ASSOC);
        if ($q==false)  return [];
        foreach ($q->fetchAll() as $item) {
           $result[] = new Uri($item["uri"], $item["id"], $item["parent_id"]);
        }

        return $result;

    }

    public function Add(Uri $item):int {
        $q = $this->pdo->prepare("INSERT INTO uris(uri, parent_id) VALUES(:uri, :parent_id)");
        $q->execute(["uri"=>$item->getUri(), "parent_id"=>$item->getParentId()]);
        return $this->pdo->lastInsertId();
    }


}