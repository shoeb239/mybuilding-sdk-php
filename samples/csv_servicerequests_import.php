<?php
/**
 * Sample code to import a CSV file of service requests data using the Service requests API
 * 
 * CSV Format: Unit, RequestId, Status, Category, Description, Permission, Submit Time
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
$communityId = '10';


$client = new Services_MyBuilding($base_url, $app_id, $app_key);

$row = 0;
if (($handle = fopen("samples/csv_servicerequests_import.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
	    if ($row==0) {
			$row++;
	    	continue;
	    }
	
	    $unit = $data[0];
	    $requestId = $data[1];
	    $status = $data[2];
	    $category = $data[3];
	    $description = $data[4];
	    $permission = $data[5];
	    $submit_time = $data[6];
	    
	    try {
	    	$response = $client->serviceRequests->add(array('communityId' => $communityId, 
			                                                 'unit'        => $unit, 
															 'status'      => $status, 
															 'category'    => $category, 
															 'description' => $description,
															 'permission'  => $permission, 
															 'submit_time' => $submit_time));
															 
			$requestId = isset($response->requestId) ? $response->requestId : '';										 
	    	echo 'Service request was imported to ' . $unit . " - Request ID (" . $requestId . ")" . "\n";;
	    } catch (Services_MyBuilding_RestException $e) {
	    	echo 'Service Request was not imported to ' . $unit . ' - ' . $e->getMessage() . "" . "\n";	
	    }
	    
	    $row++;
	}
    
   
    fclose($handle);
}