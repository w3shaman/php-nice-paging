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

// Create PDO object here
$pdo = new PDO ( Config::getDbType().":host=". Config::getHost() ."; dbname=". Config::getDbname()."", Config::getUser(), Config::getPass());
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// Inject it to nice paging
$nicePaging = new nicePaging($pdo);

// Create table
echo '<table border="0" cellspacing="1" cellpadding="3" width="500" align="center" class="table">';
	echo '<tr class="header"><th width="50">ID</th><th width="450">Title</th></tr>';

	$rowsPerPage=10; // Rows per page

	// Pager query
	$sql = "Select id, title from sample";
	$data = $nicePaging->query($sql, $rowsPerPage);

	foreach($data as $k=>$v){
		echo '<tr class="row"><td>'.$v->id.'</td><td>'.$v->title .'</td></tr>';
	}

echo '<table>';

$link="sample2.php?option=test"; // Page name

$nicePaging->setSeparator("&"); // Separator between page name and query string for page number

echo $nicePaging->createPaging($link);

// Close the connection
$pdo = null;

?>
</body>
</html>
