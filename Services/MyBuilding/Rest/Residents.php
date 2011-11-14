<?php

class Services_MyBuilding_Rest_Residents extends Services_MyBuilding_Resource
{

	/**
	 * fetch all residents in a unit
	 * 
	 * @param int $communityId
	 * @param string $unit
	 * @throws Service_MyBuilding_Exception
	 */
	public function listAll($communityId, $unit) {
		$params = array('communityId' => $communityId, 'unit' => $unit);
		
		$response = $this->proxy->retrieveData("residents/list", $params);
		return $response->residents->resident;
	}
	
	/**
	 * fetch all residents in a unit by corporate ids
	 * 
	 * @param string $corporateCommunityId
	 * @param string $corporateUnitId
	 * @throws Service_MyBuilding_Exception
	 */
	public function listAllByCorporate($corporateCommunityId, $corporateUnitId) {
		$params = array('corporateCommunityId' => $corporateCommunityId, 'corporateUnitId' => $corporateUnitId);
		
		return $this->proxy->retrieveData("residents/list", $params);
	}
	
	
	/**
	 * transfer a resident to a different unit
	 *
	 * @param int $communityId
	 * @param int $residentId
	 * @param string $unit
	 */
	public function transfer($communityId, $residentId, $unit) {
		$params = array('communityId' => $communityId, 'residentId' => $residentId, 'unit' => $unit);
	
		return $this->proxy->retrieveData("residents/transfer", $params);
	}
	
	/**
	 * transfer a resident to a different unit
	 *
	 * @param string $corporateCommunityId
	 * @param string $corporateTenantId
	 * @param string $corporateUnitId
	 */
	public function transferByCorporate($corporateCommunityId, $corporateTenantId, $corporateUnitId) {
		$params = array('corporateCommunityId' => $corporateCommunityId, 'corporateTenantId' => $corporateTenantId, 'corporateUnitId' => $corporateUnitId);
	
		return $this->proxy->createData("residents/transfer", $params);
	}
	
	/**
	 * moveout (reset) all residents in a unit
	 * 
	 * @param int $communityId
	 * @param string $unit
	 */	
	public function moveout($communityId, $unit) {
		$params = array('communityId' => $communityId, 'unit' => $unit);
				
		return $this->proxy->retrieveData("residents/remove", $params);
	}

	/**
	 * move out (reset) all residents in a unit
	 * 
	 * @param string $corporateCommunityId
	 * @param string $corporateUnitId
	 */
	public function moveoutByCorporate($corporateCommunityId, $corporateUnitId) {
		$params = array('corporateCommunityId' => $corporateCommunityId, 'corporateUnitId' => $corporateUnitId);
		
		return $this->proxy->retrieveData("residents/remove", $params);
	}
	
	/**
	 * remove a single resident
	 * 
	 * @param int $communityId
	 * @param string $residentId
	 */	
	public function remove($communityId, $residentId) {
		$params = array('communityId' => $communityId, 'residentId' => $residentId);
				
		return $this->proxy->retrieveData("residents/remove", $params);
	}

	/**
	 * remove a single resident
	 * 
	 * @param string $corporateCommunityId
	 * @param string $corporateTenantId
	 */
	public function removeByCorporate($corporateCommunityId, $corporateTenantId) {
		$params = array('corporateCommunityId' => $corporateCommunityId, 'corporateTenantId' => $corporateTenantId);
		
		return $this->proxy->retrieveData("residents/remove", $params);
	}
	
	/**
	 * add a resident
	 * 
	 * @param array $params
	 */
	public function add($params) {
		return $this->proxy->createData("residents/add", $params);
	}

	/**
	 * update a resident
	 * 
	 * @param array $params
	 */
	public function update($params) {
		return $this->proxy->createData("residents/update", $params);
	}	
}
