<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/projects', 'getProjects');

$app->run();

function getProjects() {
	$sql = "select * FROM projects";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$projects = $stmt->fetchAll();
		$db = null;
		// echo '{"wine": ' . json_encode($wines) . '}';
		echo json_encode($projects);
	} 
	catch(PDOException $e) {
		
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getConnection() {
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="root";
	$dbname="theportfolio";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>