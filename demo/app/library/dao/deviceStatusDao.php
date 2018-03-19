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

	public $tableName = "DeviceStatus";
	private $fields = "deviceID,status";
	
	
	public function addDevice($device) {
		$this->getUtil('log')->write("device status Dao...");		
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

	public function updateStatus($deviceName, $status) {
		$sql = "update $this->tableName set status = {$status} where DeviceID = {$deviceName}";

		return $this->init_db()->update_by_field($status, status, $this->tableName);
	}

}
