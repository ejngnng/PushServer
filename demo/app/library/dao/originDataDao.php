<?php
/*********************************************************************
 *
 *Description: origin data dao
 *
 *Author:      ningjiang@baicells.com
 *
 *Date:        created by 2017-07-25
 *
 *********************************************************************/

class originDataDao extends Dao {

	public $tableName = "originData";
	private $fields = "deviceID,location,dataTime,data";
	
	
	public function addData($data) {
		$this->getUtil('log')->write("origin data Dao...");		
		$device = $this->init_db()->build_key($data, $this->fields);
		return $this->init_db()->insert($data, $this->tableName);
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
