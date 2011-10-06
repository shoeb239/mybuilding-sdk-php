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

// Stage
$base_url = 'api.mybuilding.org';
$app_id = 'ABC';
$app_key = '1234';


$client = new Services_MyBuilding($base_url, $app_id, $app_key);
$communityId = 1;

$row = 0;
if (($handle = fopen("samples/csv_mass_invite.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
	    if ($row==0) {
			$row++;
	    	continue;
	    }
	
	    $unit = $data[0];
	    $firstName = $data[1];
	    $lastName = $data[2];
	    $email = $data[3];
	    
	    try {
	    	$residentId = $client->residents->add(array('communityId' => $communityId, 'unit' => $unit, 'firstName' => $firstName, 'lastName' => $lastName, 'emailAddress' => $email, 'sendInvitation' => 'Y'));
	    	echo $email . ' was invited to ' . $unit . " - Resident ID (" . $residentId . ")\n";
	    } catch (Services_MyBuilding_RestException $e) {
	    	echo $email . ' not invited to ' . $unit . ' - ' . $e->getMessage() . "\n";	
	    }
	    
	    $row++;
	}
    
   
    fclose($handle);
}