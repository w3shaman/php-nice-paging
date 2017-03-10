<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html>
<head>
	<title>Nice Paging - Default Usage</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<?php
<<<<<<< HEAD
// Include class
include("nicePaging.php");

// Configuration file
require_once "config.php";

// Create instance
$paging=new nicePaging($pdo);
=======
// auto load classes
spl_autoload_register( function($class) { require_once $class.'.php'; } );
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f

// Create table
echo '<table border="0" cellspacing="1" cellpadding="3" width="500" align="center" class="table">';
	echo '<tr class="header"><th width="50">ID</th><th width="450">Title</th></tr>';
		
	$rowsPerPage=10; // Rows per page
	
	// Pager query
<<<<<<< HEAD
	$result=$paging->pagerQuery("SELECT id, title FROM sample", $rowsPerPage);
	foreach($result as $key => $value){
		// Display row
		echo '<tr class="row"><td>'.$key = $value->id.'</td><td>'.$value->title.'</td></tr>';
=======
	$sql = "Select id, title from sample";
	$data = nicePaging::getInstance()->query($sql, $rowsPerPage);
	
	foreach($data as $k=>$v){
		echo '<tr class="row"><td>'.$k = $v->id.'</td><td>'.$v->title .'</td></tr>';
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
	}

echo '<table>';

$link="sample1.php"; // Page name

// Create links for paging
echo  nicePaging::getInstance()->createPaging($link);


<<<<<<< HEAD
// Close database connection
$pdo = null;
=======
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
?>
</body>
</html>
