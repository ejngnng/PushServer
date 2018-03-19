<?php
/*********************************************************************
 *
 *Description: wifi sniffer device info dao
 *
 *Author:      ningjiang@baicells.com
 *
 *Date:        created by 2017-07-01
 *
 *********************************************************************/

class deviceService extends Service {
	
	private $deviceDao;
	
	public function __construct(){
		parent::__construct();
		
		$this->deviceDao = InitPHP::getDao("deviceInfo");
	}
	
	public function createDevice($device) {
		$this->getUtil('log')->write("device Service...");
		return $this->deviceDao->addDevice($device);
	}
	
	
	/*
	 * get all device info 
	 * 
	 */
	public function getAll(){
		return $this->deviceDao->getAll();
	}
}