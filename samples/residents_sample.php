<?php
/**
 * Sample code to manage residents
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$root = realpath(dirname(dirname(__FILE__)));
$library = "$root/Services";

$path = array($library, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));

require_once 'MyBuilding.php';

unset($root, $library, $path);

$base_url = 'api.mybuilding.org';
$app_id = 'ABC';
$app_key = '1234';


$client = new Services_MyBuilding($base_url, $app_id, $app_key)

try {
	// reset an entire unit (removes all the residents, invites & access requests)
	$response = $residentsClient->residents->remove(32, '1A');
} catch (Services_MyBuilding_RestException $e) {
	echo 'error archiving unit = ' . $e->getMessage();
	exit;
}