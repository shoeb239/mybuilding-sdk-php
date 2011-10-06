## Prerequisites

* PHP >= 5.2.1
* The PHP JSON extension

## Installing

### From Source

Not using PEAR? Not a problem. Download the [source](https://github.com/mybuilding/mybuilding-sdk-php/zipball/master) which includes all dependencies.

## Sample Scripts
- csv_mass_invite.php - sending a mass invite using a CSV file
- key_log.php - send key transactions
- residents_management.php - actions on residents, such as reset a unit, add resident, update contact information

## Sample Code

### Remove all residents in a unit

```php
require "Services/MyBuilding.php";

$base_url = 'api.mybuilding.org';
$app_id = "ACXXXXXX"; // Your mybuilding app id
$app_key = "YYYYYY"; // Your mybuilding app key

$client = new Services_MyBuilding($base_url, $app_id, $app_key)

try {
	$response = $residentsClient->residents->remove(32, '1A');
} catch (Services_MyBuilding_RestException $e) {
	echo 'error archiving unit = ' . $e->getMessage();
	exit;
}
```

### Adding a resident and sending an email invitation

```php
require "Services/MyBuilding.php";

$base_url = 'api.mybuilding.org';
$app_id = "ACXXXXXX"; // Your mybuilding app id
$app_key = "YYYYYY"; // Your mybuilding app key

$client = new Services_MyBuilding($base_url, $app_id, $app_key)

try {
	$response = $residentsClient->residents->add(array('communityId' => 32, 'unit' => '1A', 'firstName' => 'Happy', 'lastName' => 'Penguin', 'emailAddress' => 'happy_p@mybuilding.org', 'sendInvitation' => 'Y));
} catch (Services_MyBuilding_RestException $e) {
	echo 'error archiving unit = ' . $e->getMessage();
	exit;
}
```



