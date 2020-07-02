<?php
	// Connect to database
	require_once './db/database.php';
	$request_method = $_SERVER["REQUEST_METHOD"];


	function getBeers()
	{
		
		$query = "SELECT * FROM beers LIMIT 50";
		$response = array();
		$stmt = EDatabase::prepare($query);
		$stmt->execute(array(':id' => $id));
		$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getBeer($id=0)
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


	switch($request_method)
	{
		
		case 'GET':
			// Retrive Beer
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				getBeer($id);
			}
			else
			{
				getBeers();
			}
			break;

		case 'POST':
			// Ajouter une bière
			AddBeer();
			break;

			break;
	}
?>