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
	full_query($query);
}

function create_table_vmware_vcenter()
{
  $query = "CREATE TABLE IF NOT EXISTS `vmware_vcenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `server` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `resourcepool` varchar(255) NOT NULL,
  `hostsystem` varchar(255) NOT NULL,
  `vmpathname` varchar(255) NOT NULL,
  `ETHNormalName` varchar(255) NOT NULL,
  `ETHNormalNetwork` varchar(255) NOT NULL,
  `ETHDSuuid` text,
  `ETHDSPGKey` varchar(255) NOT NULL,
  `NOCPSvmPoolID` int(11) NOT NULL,
  `VMHWVersion` varchar(255) NOT NULL)";
	full_query($query);
}

function create_table_vmware_freenas()
{
  $query = "CREATE TABLE IF NOT EXISTS `vmware_freenas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `server` varchar(255) NOT NULL,
  `apiuri` varchar(255) NOT NULL,
  `localip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mainvolume` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL)";
	full_query($query);
}

function create_table_vmware_vmac()
{
  $query = "CREATE TABLE IF NOT EXISTS `vmware_vmac` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `vmac` varchar(25) NOT NULL,
  `serviceid` varchar(100) NOT NULL,
  `vmac_status` enum('0','1','2') NOT NULL DEFAULT '0')";
	full_query($query);
}

function vmware_module_migrate()
{
  create_table_vmware_iplist();
  create_table_vmware_vncports();
  create_table_vmware_cron();
  create_table_vmware_vcenter();
  create_table_vmware_freenas();
  create_table_vmware_vmac();
}

function vmware_activate() 
{
	vmware_module_migrate();
}

if($_POST['updateextr'] == 1){
	
	foreach($_POST['jumpMenu'] as $key => $val){
		mysql_query("update vmware_iplist set ip_type  = '".$_POST['jumpMenu'][$key]."' where ip='".$key."' ");		
	}
}


if($submitrange == 1)
{
if (empty($ipstart))
{
$hata = "<b style='color:red;'>Ip başlangıç adresi yazın</b>";
} else if (empty($ipend))
{
$hata = "<b style='color:red;'>Ip bitiş adresi yazın</b>";
}	

else {
$ilkbu = explode('.',$ipstart);
$sonbu = explode('.',$ipend);
$ilkip = $ilkbu[3];
$sonip = $sonbu[3];
for($ilk = $ilkip; $ilk <= $sonip; $ilk++){
	$iparray[] = $ilkbu[0].'.'.$ilkbu[1].'.'.$ilkbu[2].'.'.$ilk;
}
$ipcheck = join('\', \'',$iparray);

$sql = mysql_query("select ip from vmware_iplist where ip in ('$ipcheck')");
$say = mysql_num_rows($sql);
if ($say > 0)
{
$hata = "<b style='color:red;'>Daha Önce Eklenmiş ipler var</b>";
}
else
{
	foreach($iparray as $ipz){
$sql = mysql_query("insert into vmware_iplist (ip,ip_type) values ('$ipz', '0')");

	}
$hata = "<b style='color:green;'>Ip'ler eklendi.</b>";
}	
	
}

}
if($submitip == 1)
{
if (empty($ip))
{
$hata = "<b style='color:red;'>Ip adresi yazın</b>";
} else {

$sql = mysql_query("select ip from vmware_iplist where ip = '$ip'");
$say = mysql_num_rows($sql);
if ($say > 0)
{
$hata = "<b style='color:red;'>Bu Ip Daha Önce Eklenmiş</b>";
}
else
{
$sql = mysql_query("insert into vmware_iplist (ip,ip_type) values ('$ip', '0')");
$hata = "<b style='color:green;'>$ip no'lu ip eklendi.</b>";
}	
	
}
}

function vmware_output($params) {
	
global $hata;
	
echo '<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
document.formadd.submit()
}
//-->
</script>';	
	
	echo "<div id=\"tabs\">
	<ul>
		<li id=\"tab0\" class=\"tab\"><a href=\"addonmodules.php?module=vmware\">Ip Adresses</a></li>
		<li id=\"tab1\" class=\"tab\"><a href=\"addonmodules.php?module=vmware&page=addip\">Add IP</a></li>
	</ul>
</div>";


echo '<div id="tab_content">'.$hata.'