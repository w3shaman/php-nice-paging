<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html>
<head>
	<title>Nice Paging - Working With Conjunction</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<?php
// Include class
include("nicePaging.php");

// Configuration file
include("config.php");

// Connect to database
$con=mysql_connect($host, $user, $password);
mysql_select_db($database, $con);

// Create instance
$paging=new nicePaging($con);

// Create table
echo '<table border="0" cellspacing="1" cellpadding="3" width="500" align="center" class="table">';
	echo '<tr class="header"><th width="50">ID</th><th width="450">Title</th></tr>';
	
	$rowsPerPage=10; // Rows per page
	
	// Pager query
	$result=$paging->pagerQuery("SELECT id, title FROM sample", $rowsPerPage);
	while($data=mysql_fetch_assoc($result)){
		// Display row
		echo '<tr class="row"><td>'.$data['id'].'</td><td>'.$data['title'].'</td></tr>';
	}
echo '<table>';

$link="sample2.php?option=test"; // Page name

$paging->setSeparator("&"); // Separator between page name and query string for page number

// Create links for paging
echo $paging->createPaging($link);

// Close database connection
mysql_close($con);
?>
</body>
</html>