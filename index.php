<!doctype html>
<html lang="ru">
<meta charset="utf-8"/>
<head><title>Проект 42</title></head>
<body>
<?php
$url = "http://example.com";

$mem = new Memcached();
$mem->addServer("localhost", 11211);
$isHit = !$mem->add($url, "");
var_dump($mem->getLastErrorMessage());
if ($isHit&&$mem->getLastErrorCode()===Memcached::RES_NOTSTORED) {
    $matches = unserialize($mem->get($url));
}
else {


    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);
    preg_match_all("#<a.*?href=\"(.*?)\".*?>(.*?)</a>#",$content,$matches);
    $mem->set($url, serialize($matches));
    }


var_dump($matches);


?>


</body>

</html>