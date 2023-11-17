<?php
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use WindowsAzure\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(['KEY']);
//echo "Key: " . $_ENV['KEY'];

$client = new Client();
$res = $client->get('https://tue.atlassian.net/rest/api/3/attachment/content/10384', [
    'auth' =>  ['d.gerritsen@tue.nl', $_ENV['KEY']]
]);
echo $res->getStatusCode();           // 200
print_r($res);
print_r($res->getHeader('content-type')); // 'application/json; charset=utf8'
$content_bytes = $res->getbody();
$file = fopen('download.pdf', "w");
$success = fwrite($file, $content_bytes);
fclose($file);

echo "test1<br>";

$connectionString = "DefaultEndpointsProtocol=https;AccountName=stdeniswebdev;AccountKey=T8nv+fFo346qi2uFhIp6mN1BEOTNrbn2fABcaGcB3jK8DXcb/BqHpOFFjJOVSwfBvJ1KgBqv+vHb+AStuI4z9g==";

// Create blob REST proxy.
$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

echo "test2<br>"; 

$blob_name = "created pdf from Jira.zip";

try     {
        $file = fopen('download.pdf', "r");
        //Upload blob
        //$options = new CreateBlobOptions();
        //$options->setBlobContentType("application/zip");
        $blobRestProxy->createBlockBlob("st-denis-webdev-blobcontainer", $blob_name, $file);
        fclose($file);
}
catch(ServiceException $e){
        // Handle exception based on error codes and messages.
        // Error codes and messages are here:
        // http://msdn.microsoft.com/library/azure/dd179439.aspx
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
}

echo "test3<br>";
//echo $res->getBody();                 // {"type":"User"...'
//var_export($res->json());
//
echo "End of php file reached without errors..<br />\n"; 
fclose($file);
?>