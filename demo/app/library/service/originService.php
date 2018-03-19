<?php
/*********************************************************************
 *
 *Description: origin data save service
 *
 *Author:      ningjiang@baicells.com
 *
 *Date:        created by 2017-07-25
 *
 *********************************************************************/

class originService extends Service {
	
	private $originDao;
	
	public function __construct(){
		parent::__construct();
		
		$this->originDao = InitPHP::getDao("originData");
	}
	
	public function createData($data) {
		$this->getUtil('log')->write("origin data Service...");
		$valueCount = count($data['data']);
		$temp = array();
		$temp['deviceID'] = $data['deviceID'];
		$temp['location'] = $data['location'];
		$temp['dataTime'] = $data['dataTime'];
		for($i = 0; $i < $valueCount; $i++){
			$temp['data'] = $data['data'][$i];
			$this->originDao->addData($temp);
		}
 
//		return $this->originDao->addData($data);
		return;
	}
	
	
	/*
	 * get all device info 
	 * 
	 */
	public function getAll(){
		return $this->deviceDao->getAll();
	}
}
