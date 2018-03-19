--
-- Description: for video server db tables
--
-- Author: 		ningjiang@baicells.com
--
-- Date:		created by 2017-01-09  



USE ALARM_DB;


CREATE TABLE originData
(
	id 					int NOT NULL auto_increment,
	deviceID 			text,
	location 			text,
	dataTime 			text,
	data                int,
	
	PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

