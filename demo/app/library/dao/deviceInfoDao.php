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

class deviceInfoDao extends Dao {

	public $tableName = "DeviceInfo";
	private $fields = "deviceID,location,status,dataTime";
	
	
	public function addDevice($device) {
		$this->getUtil('log')->write("device Info Dao...");		
		$device = $this->init_db()->build_key($device, $this->fields);
		return $this->init_db()->insert($device, $this->tableName);
	}
	
	/*
	 * get all device info
	 * 
	 */
	public function getAll(){
		$sql = "SELECT * FROM $this->tableName ORDER BY dataTime DESC LIMIT 10";
		
		return $this->init_db()->get_all_sql($sql);
	}

}
