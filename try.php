<?php
require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->test->text;

$cursor = $collection->find();
foreach($cursor as $document){
	echo $document["score"];
}

?>

