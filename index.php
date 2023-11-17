<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();
$res = $client->get('https://tue.atlassian.net/rest/api/3/attachment/content/10384', [
    'auth' =>  ['d.gerritsen@tue.nl', '<token>']
]);
echo $res->getStatusCode();           // 200
print_r($res->getHeader('content-type')); // 'application/json; charset=utf8'
//echo $res->getBody();                 // {"type":"User"...'
//var_export($res->json());
?>
