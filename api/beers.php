<?php
	// Connect to database
	require_once './db/database.php';
	$request_method = $_SERVER["REQUEST_METHOD"];


	function getProducts()
	{
		
		$query = "SELECT * FROM beers LIMIT 50";
		$response = array();
		$stmt = EDatabase::prepare($query);
		$stmt->execute(array(':id' => $id));
		$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getProduct($id=0)
	{
		$query = "SELECT * FROM beers";
		if($id > 0)
		{
			$query .= " WHERE id=:id LIMIT 1";
		}
		$response = array();
		$stmt = EDatabase::prepare($query);
		$stmt->execute(array(':id' => $id));
		$response = $stmt->fetchAll(PDO::FETCH_BOTH);
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}


?>