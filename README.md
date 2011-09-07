## Prerequisites

* PHP >= 5.2.1
* The PHP JSON extension

## Installing

### From Source

Not using PEAR? Not a problem. Download the [source](https://github.com/mybuilding/mybuilding-sdk-php/zipball/master) which includes all dependencies.


## Sample Code

### Making a Call

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


