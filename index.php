<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();
$res = $client->get('https://tue.atlassian.net/rest/api/3/attachment/content/10384', [
    'auth' =>  ['d.gerritsen@tue.nl', 'ATATT3xFfGF0ImglyoTuol968p4JQOarDkYtG6m_xExxkKW3DsutM4NDj0TwIiJFFk-vb1SUkmS1e8xhZQMMGuXvJ-DyXjePkg_JsnhgBly7W1aMVr0aoSnz113CYmy1b7H5SmUObYfd17Mfr7YugJ5yOu2SFSrG8LbS9Z1M8J9RuDbbzCTQsNE=B6AC4180']
]);
echo $res->getStatusCode();           // 200
print_r($res->getHeader('content-type')); // 'application/json; charset=utf8'
//echo $res->getBody();                 // {"type":"User"...'
//var_export($res->json());
?>
