--
-- Description: for video server db tables
--
-- Author: 		ningjiang@baicells.com
--
-- Date:		created by 2017-01-09  

USE ALARM_DB;


CREATE TABLE DeviceStatus
(
	id 					int NOT NULL auto_increment,
	deviceID 			text,
	status 				text,
	
	PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

