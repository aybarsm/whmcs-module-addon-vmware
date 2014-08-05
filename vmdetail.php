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



<div class="tablebg">
<table id="sortabletbl1" class="datatable" width="100%" border="0" cellspacing="1" cellpadding="3">
<tr>
<tr><td>Adı</td><td><?=$name;?></td></tr>
<tr><td>Cpu</td><td><?=$cpu;?></td></tr>
<tr><td>Ram</td><td><?=$ram;?></td></tr>
<tr><td>Disk</td><td><?=$disk;?></td></tr>
<tr><td>VMTools</td><td><?=$tools;?></td></tr>
<tr><td>Power</td><td><?=$power;?></td></tr>
</table>
</div>

<p align="center"><input type="button" value="Close Window" onClick="window.close()" class="button" /></p>



</td></tr></table>

</body>
