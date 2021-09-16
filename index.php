<?php

require_once "vendor/autoload.php";
spl_autoload_register(function ($className) {require_once './app/classes/'.$className.'.inc';});

$url = "http://example.com";
$client = new GuzzleClient($url);
try {
    $content = $client->get('http://gimsyaroslavl.narod.ru/Rescuer/Rescuers_Guidebook/ch143_flood.htm');
}
catch (UnsuccessfulRequestException $ure) {
    throw new Exception($ure->getMessage()." Code: ".$ure->getCode()." Http message: ".$ure->getHttpReason());
}
catch (NotInitializedException $nie) {
    throw new Exception("Client not initialized for some mysterious reason");
}

$parser = new UriParser($content);
$result = $parser->getResult();
$host = "localhost";
$port = 5432;
$dbname = "news";
$user = "student";
$password = "password";
$uridb = new UriDB($host, $port, $dbname, $user, $password);
$parent = $uridb->Add(new Uri($url));
foreach ($result as $uri) {
  $uridb->Add(new Uri($uri, null, $parent));
}
$dbresult = $uridb->GetAllUris();
echo Renderer::render('uris', ['uris'=> $dbresult]);
/*

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

$statement = $pdo->prepare("INSERT INTO uris(uri, parent_id) VALUES(:uri, :parent_id)");

foreach ( $parser->getResult() as $uri) {
    $statement->execute(["uri" =>$uri, "parent_id" => null]);
}


$query = $pdo->query("SELECT uri FROM uris");
*/
