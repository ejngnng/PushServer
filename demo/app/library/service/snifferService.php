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

class snifferService extends Service {
	
	private $snifferDao;
	
	public function __construct(){
		parent::__construct();
		
		$this->snifferDao = InitPHP::getDao("snifferInfo");
	}
	
	public function createSniffer($sniffer) {

		return $this->snifferDao->addSniffer($sniffer);
	}
	
	
	/*
	 * get all sniffer info
	 * 
	 */
	public function getAll(){
		return $this->snifferDao->getAll();
	}
	
}