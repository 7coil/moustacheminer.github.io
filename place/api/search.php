<?php
	if(isset($_GET['username']) || isset($_GET['x']) || isset($_GET['y']) || isset($_GET['colour']) ) {
		$servername = "127.0.0.1";
		$serveruser = "reddit";
		$serverpass = "redditsips";
		$db = "reddit";
		$rows = array();

		$conn = new mysqli($servername, $serveruser, $serverpass, $db);

		if($conn->connect_errno > 0){
			die('{"error": "There was an mySQL connection error"}');
		}

		$username = base64_encode(sha1(mysqli_real_escape_string($conn, $_GET['username'])));
		$x = mysqli_real_escape_string($conn, $_GET['x']);
		$y = mysqli_real_escape_string($conn, $_GET['y']);
		$colour = mysqli_real_escape_string($conn, $_GET['colour']);

		$wheres = array();

		if($username) {
			$wheres[] = 'user_hash = "' . $username . '"';
		}

		if($x || $x === 0) {
			$wheres[] = 'x_coordinate = ' . $x;
		}

		if($y || $y === 0) {
			$wheres[] = 'y_coordinate = ' . $y;
		}

		if($colour || $colour === 0) {
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
	} else {
		die('{"error": "You did not send a GET request with username, x, y and/or colour"}');
	}
?>
