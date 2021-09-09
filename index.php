<!doctype html>
<html lang="ru">
<meta charset="utf-8"/>
<head><title>Проект 42</title></head>
<body>
<?php
require_once "vendor/autoload.php";

use GuzzleHttp\Client;

$url = "http://example.com";
$client = new Client(["base_uri" => 'http://gimsyaroslavl.narod.ru/', 'timeout'=>2]);
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

var_dump($matches);


?>


</body>

</html>