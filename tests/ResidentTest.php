<?php

use \Mockery as m;

class ResidentTest extends PHPUnit_Framework_TestCase {
    function tearDown() {
        m::close();
    }
    
    function testNeedsRefining() {
        $http = m::mock(new Services_MyBuilding_TinyHttp);
        
        $mockup = array(
       		'response' => array(
        	),
        	'status' => 'success'
        );
        $mockup['response']['residents'][] = array(
        			'residentId' => '140027_1',
        			'residentType' => 'RENTER',
        			'firstName' => 'Happy',
        			'lastName' => 'Penguin',
        			'emailAddress' => 'happy_p@mybuilding.org'
        			);
        
        
        $http->shouldReceive('get')->once()
            ->with('/residents/list?communityId=999&unit=111&format=json&app_id=123&app_key=456')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode($mockup
                                
                )
            ));
            
        $client = new Services_MyBuilding('AC123', '123', '456', $http);
        $response = $client->residents->listAll('999', '111');
		$resident = array_pop($response->residents);

		$this->assertEquals('140027_1', $resident->residentId);
       	$this->assertEquals('RENTER', $resident->residentType);
		$this->assertEquals('Happy', $resident->firstName);
		$this->assertEquals('Penguin', $resident->lastName);
		$this->assertEquals('happy_p@mybuilding.org', $resident->emailAddress);
    }
    
}