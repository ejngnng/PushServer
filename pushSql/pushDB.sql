--
-- Description: for video server db tables
--
-- Author: 		ningjiang@baicells.com
--
-- Date:		created by 2017-01-09  

DROP DATABASE IF EXISTS ALARM_DB;

CREATE DATABASE ALARM_DB;

USE ALARM_DB;


CREATE TABLE SnifferInfo
(
	id 					int NOT NULL auto_increment,
	deviceID 			text,
	status 				text,
	dataTime 			text,
	
	PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

CREATE TABLE DeviceInfo
(
	id 					int NOT NULL auto_increment,
	deviceID			text,
	location		    text,
	status				text,
	dataTime			text,
	PRIMARY KEY (id)
)DEFAULT CHARSET=utf8;