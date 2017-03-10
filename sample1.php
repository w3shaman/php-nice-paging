<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html>
<head>
	<title>Nice Paging - Default Usage</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<?php
// auto load classes
spl_autoload_register( function($class) { require_once $class.'.php'; } );

// Create table
echo '<table border="0" cellspacing="1" cellpadding="3" width="500" align="center" class="table">';
	echo '<tr class="header"><th width="50">ID</th><th width="450">Title</th></tr>';

	$rowsPerPage=10; // Rows per page

	// Pager query
	$sql = "Select id, title from sample";
	$data = nicePaging::getInstance()->query($sql, $rowsPerPage);

	foreach($data as $k=>$v){
		echo '<tr class="row"><td>'.$k = $v->id.'</td><td>'.$v->title .'</td></tr>';
	}

echo '<table>';

$link="sample1.php"; // Page name

// Create links for paging
echo  nicePaging::getInstance()->createPaging($link);


?>
</body>
</html>
