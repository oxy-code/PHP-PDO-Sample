<?php
	require_once('Database.php');
	echo "<pre>";
	$db_config = array(
		'database' => 'velutask',
		'username' => 'root',
		'password' => '',
		'host' => 'localhost'
	);
	// Creating new Instance
	$db = new Database($db_config);
	//$query_result = $db->query("SELECT * FROM names");
	$params = array('table_name' => 'names', 'conditions' => array('text' => 'selvem', 'is_enable' => 1));
	$find_result = $db->find($params);
	//print_r($query_result);
	print_r($find_result);
	echo "</pre>";
?>
