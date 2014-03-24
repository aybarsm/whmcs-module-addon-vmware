<?php
function vmware_config() {
    $configarray = array(
    "name" => "VMware",
	"fields" => array(
			"cronkey" => array ( "FriendlyName" => "Cron Key", "Type" => "password", "Size" => "50" )
     ));
    return $configarray;
}

require_once("../modules/servers/vmware/vmware.php");

function create_table_vmware_iplist()
{
  $query = "CREATE TABLE IF NOT EXISTS `vmware_iplist` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ip` varchar(15) NOT NULL,
    `vmid` varchar(15) NOT NULL,
    `clientid` varchar(15) NOT NULL,
    `serviceid` varchar(100) NOT NULL,
    `vmac` varchar(100) NULL,
    `ip_type` enum('0','1','2') NOT NULL DEFAULT '0')";
	full_query($query);
}

function create_table_vmware_vncports()
{
  $query = "CREATE TABLE IF NOT EXISTS `vmware_vncports` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `vmid` varchar(15) NOT NULL,
  `hostip` varchar(30) NOT NULL,
  `vncport` varchar(30) NOT NULL,
  `serviceid` varchar(100) NOT NULL)";
	full_query($query);
}

function create_table_vmware_cron()
{
  $query = "CREATE TABLE IF NOT EXISTS `vmware_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `process` varchar(30) NOT NULL,
  `added` datetime DEFAULT NULL,
  `serviceid` varchar(100) NOT NULL,
  `lockjob` enum('0','1') NOT NULL DEFAULT '0',
  `lastrun` datetime DEFAULT NULL,
  `done` enum('0','1') NOT NULL DEFAULT '0',
  `finished` datetime DEFAULT NULL,
  `result` text)";