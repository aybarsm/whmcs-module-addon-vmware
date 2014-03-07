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