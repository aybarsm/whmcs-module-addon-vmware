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