<!doctype html>
<html lang="ru">
<meta charset="utf-8"/>
<head><title>Проект 42</title></head>
<body>
<?php
require_once "vendor/autoload.php";

/*
$url = "http://example.com";
$client = new Client(["base_uri" => 'http://gimsyaroslavl.narod.ru/', 'timeout' => 2]);
$response = $client->get('Rescuer/Rescuers_Guidebook/ch143_flood.htm');
?>
<table style="border: solid 2px">
    <tbody>
    <tr>
        <td>Response code:</td>
        <td><?= $response->getStatusCode() ?></td>
    </tr>
    <tr>
        <td>Response status:</td>
        <td><?= $response->getReasonPhrase() ?></td>
    </tr>


    </tbody>
</table>


<?php
$content = $response->getBody();

//echo htmlspecialchars($content);
$matches = [];
preg_match_all("#<a\s+(?:[^>]*?\s+)?href=\"(http://.*?)\"#", $content, $matches);

var_dump($matches);*/
$host = "localhost";
$port = 5432;
$dbname = "news";
$user = "student";
$password = "password";
$conn = sprintf(
    "pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s",
    $host,
    $port,
    $dbname,
    $user,
    $password
);
$pdo = new PDO($conn);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
$statement = $pdo->prepare("INSERT INTO uris(uri, parent_id) VALUES(:uri, :parent_id)");

foreach ( $matches[1] as $uri) {
    $statement->execute(["uri" =>$uri, "parent_id" => null]);
}
*/

$query = $pdo->query("SELECT uri FROM uris");

?>
<ul>
    <?php while ($res = $query->fetch(PDO::FETCH_ASSOC)): ?>
        <li><?= $res["uri"] ?></li>
    <?php endwhile; ?>

</ul>


</body>

</html>