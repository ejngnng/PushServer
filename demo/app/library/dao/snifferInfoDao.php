<?php
/*********************************************************************
 *
 *Description: wifi sniffer message push server
 *
 *Author:      ningjiang@baicells.com
 *
 *Date:        created by 2017-07-01
 *
 *********************************************************************/

class SnifferInfoDao extends Dao {
	
	public $tableName = 'SnifferInfo';
	private $fields = "deviceID,status,dataTime";
	

	public function addSniffer($sniffer) {
		$this->getUtil('log')->write("sniffer Info Dao...");	
		$sniffer = $this->init_db()->build_key($sniffer, $this->fields);
		return $this->init_db()->insert($sniffer, $this->tableName);
	}
	
	/*
	 * get all sniffer info
	 * 
	 */
	public function getAll(){
		$sql = "SELECT * FROM $this->tableName ORDER BY dataTime DESC LIMIT 10";  
		
		return $this->init_db()->get_all_sql($sql);
	}
}
