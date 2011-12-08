<?php

class Services_MyBuilding_Rest_ServiceRequests extends Services_MyBuilding_Resource
{
	/**
	 * add a service request
	 * 
	 * @param array $params
	 */
	public function add($params) {
		return $this->proxy->createData("servicerequests/add", $params);
	}
}
