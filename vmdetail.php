<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../../admin/templates/blend/style.css" rel="stylesheet" type="text/css">
<link href="../../../includes/jscript/css/ui.all.css" rel="stylesheet" type="text/css" />
<body style="margin:0px">
<?php

require_once("../../servers/vmware/vmware.php");

$sendparams['function'] = "getVMDeatilbyID";
$sendparams['params'] = $_GET['id'];
$info = callApiFunc($sendparams);
foreach($info['propSet'] as $props){
	if($props[name] == 'config.hardware.memoryMB'){$ram = $props[val];}
	if($props[name] == 'config.hardware.numCPU'){$cpu = $props[val];}
	if($props[name] == 'guest.disk'){$disc = $props[val];}
	if($props[name] == 'name'){$name = $props[val];}
	if($props[name] == 'runtime.powerState'){$power = $props[val];}
	if($props[name] == 'guest.toolsStatus'){$tools = $props[val];}
}
?>
<table width="100%" bgcolor="#ffffff" cellpadding="15"><tr><td>

<h2>VDS Özellikleri</h2>
