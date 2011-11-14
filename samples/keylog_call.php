<?php
/**
 * Sample code to call the key log api
 * 
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$root = realpath(dirname(dirname(__FILE__)));
$library = "$root/Services";

$path = array($library, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));

set_time_limit(300);
ini_set('memory_limit', '264M');

require_once 'MyBuilding.php';

unset($root, $library, $path);

$base_url = 'api.v1.mybuilding.org';
$app_id = 'ABC';
$app_key = '123';



$client = new Services_MyBuilding($base_url, $app_id, $app_key);


try {
	// signout a key
	$response = $client->createData('keylog/signout', array('communityId' => 'ABC', 'keyId' => 'DOOR'));
	var_dump($response);
} catch (Exception $e) {
	echo 'error - ' . $e->getMessage() . "\n";
}

echo 'done';
