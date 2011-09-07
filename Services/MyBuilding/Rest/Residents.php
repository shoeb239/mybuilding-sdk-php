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
		
		return $this->proxy->retrieveData("residents/list", $params);
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
	 * remove (reset) all residents in a unit
	 * 
	 * @param int $communityId
	 * @param string $unit
	 */	
	public function remove($communityId, $unit) {
		$params = array('communityId' => $communityId, 'unit' => $unit);
				
		return $this->proxy->retrieveData("residents/remove", $params);
	}

	/**
	 * remove (reset) all residents in a unit
	 * 
	 * @param string $corporateCommunityId
	 * @param string $corporateUnitId
	 */
	public function removeByCorporate($corporateCommunityId, $corporateUnitId) {
		$params = array('corporateCommunityId' => $corporateCommunityId, 'corporateUnitId' => $corporateUnitId);
		
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
