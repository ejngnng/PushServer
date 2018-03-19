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

require_once(dirname(__FILE__) . '/Demo.php');

define(Appkey, "5937c67d310c93749e001e5f");
define(MasterSecret, "iepgsbida96b9q0yn4l9zgz4dgjghsro");

class indexController extends Controller {

	public $initphp_list = array('run','push'|get-post, 'alive'|get-post, 'record' |get-post, 'origin'|get-post); //Action白名单
	
	private $deviceService;
	
	private $snifferService;

	private $originService;

	public function __construct(){
		parent::__construct();
		
		$this->deviceService = InitPHP::getService("device");
		$this->snifferService = InitPHP::getService("sniffer");
		$this->originService = InitPHP::getService('origin');
	}

	public function run() {
// 		$this->view->display("index/run");
		$this->getUtil('log')->write("run push server test!!!");
	}
	
	/*
	 * msg push from device and push to UE
	 *  
	 */
	public function push(){

		$deviceInfo = array();
		$this->getUtil('log')->write("sniffer message...");
		$body = file_get_contents("php://input");
		$data = json_decode($body,true);

		if(!strcmp($data['status'], "0" )){
			$data['status'] = "没人";
		}
		
		if(!strcmp($data['status'], "1")){
			$data['status'] = "有人";
		}
		
		//insert sniffer statue to db
		$this->snifferService->createSniffer($data);
		
		// Set your appkey and master secret here
		$demo = new Demo(Appkey, MasterSecret);
		
		
		$txt = $data['deviceID'] . " " . $data['status'] . " " . $data['dataTime'];    
		
		$this->getUtil('log')->write($txt);
		$demo->sendAndroidBroadcast($txt);
	}
	
	/*
	 * heartbeat interface for device
	 * 
	 */
	public function alive(){
		$this->getUtil('log')->write("get heartbeat ...");

		$body = file_get_contents("php://input");
// 		error_log($body);
		$data = json_decode($body, true);
		
// 		$this->getUtil('log')->write("deviceID: " . $data['deviceID']);
// 		$this->getUtil('log')->write("location: " . $data['location']);
// 		$this->getUtil('log')->write("status: " . $data['status']);
// 		$this->getUtil('log')->write("dataTime: " . $data['dataTime']);
		$data['status'] = "在线";
		$this->deviceService->createDevice($data);
	}


	public function origin(){
		$this->getUtil('log')->write("save origin data...");

		$body = file_get_contents("php://input");
		error_log($body);
		$data = json_decode($body, true);
		$this->getUtil('log')->write("deviceID: " . $data['deviceID']);
		$this->getUtil('log')->write("location: " . $data['location']);
		$this->getUtil('log')->write("dataTime: " . $data['dataTime']);
		$this->getUtil('log')->write("data counte: " . count($data['data']));
		$this->originService->createData($data);
	}

	
	/*
	 * get record history interface for UE
	 * 
	 */
	public function record(){
		$this->getUtil('log')->write("get record history ...");	
		$body = file_get_contents("php://input");
		$request = json_decode($body, true);
		
//		echo json_encode($this->getDeviceRecord());
		
		// user status
		if(!strcmp($request['key'],"user")){
			
		}
		
		// device alive status
		if(!strcmp($request['key'], "device")){
			$this->getUtil('log')->write("get device info...");
			echo json_encode($this->getDeviceRecord());
		}
		
		// sniffer status
		if(!strcmp($request['key'],"sniffer")){
			$this->getUtil('log')->write("get sniffer info...");
			echo json_encode($this->getSnifferRecord());
		}
	}
	
	/*
	 * get device status record for UE
	 * 
	 */
	private function getDeviceRecord(){
		$this->getUtil('log')->write("get device status record ...");
		return $this->deviceService->getAll();
	}
	
	/*
	 * get wifi sniffer record  for UE
	 * 
	 */
	private function getSnifferRecord(){
		$this->getUtil('log')->write("get sniffer status record ...");
		return $this->snifferService->getAll();
	}
}
