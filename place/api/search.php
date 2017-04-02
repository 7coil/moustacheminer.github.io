<?php
	ini_set('memory_limit', '256M');
	$servername = "127.0.0.1";
	$serveruser = "reddit";
	$serverpass = "redditsips";
	$db = "reddit";
	$rows = array();

	$conn = new mysqli($servername, $serveruser, $serverpass, $db);

	if($conn->connect_errno > 0){
		die('{"error": "There was an mySQL connection error"}');
	}

	$username = mysqli_real_escape_string($conn, $_GET['username']);
	$x = mysqli_real_escape_string($conn, $_GET['x']);
	$y = mysqli_real_escape_string($conn, $_GET['y']);
	$colour = mysqli_real_escape_string($conn, $_GET['colour']);

	$wheres = array();

	if($username) {
		$wheres[] = 'username = "' . $username . '"';
	}

	if($x) {
		$wheres[] = 'x = ' . $x;
	}

	if($y) {
		$wheres[] = 'y = ' . $y;
	}

	if($colour) {
		$wheres[] = 'colour = ' . $colour;
	}

	$where_string = implode(' AND ', $wheres);

	$sql = "SELECT * FROM place";
	if ($where_string) {
		$sql .= " WHERE " . $where_string;
	}

	$result = $conn->query($sql) or die('{"error": "The mySQL query returned an error."}');

	$rows['error'] = "false";

	if(mysqli_num_rows($result) < 1) {
		die('{"error": "No results."}');
	}

	while($row = $result->fetch_assoc()){
		$rows['info'][] = $row;
	}

	$conn->close();

	print json_encode($rows);
?>
