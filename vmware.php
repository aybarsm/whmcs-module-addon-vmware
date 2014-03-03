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
