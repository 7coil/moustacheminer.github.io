<?php
	if(isset($_GET['username'])) {
		$servername = "127.0.0.1";
		$serveruser = "reddit";
		$serverpass = "redditsips";
		$db = "reddit";
		$rows = array();

		$conn = new mysqli($servername, $serveruser, $serverpass, $db);

		$input = base64_encode(sha1(mysqli_real_escape_string($conn, $_GET['username'])), true);

		if($conn->connect_errno > 0){
			die('{"error": "There was an mySQL connection error"}');
		}

		$sql = "SELECT * FROM tile_placements WHERE user_hash LIKE '" . $input . "';";
		
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
		die('{"error": "You did not send a GET request with ?username=xyz"}');
	}
?>
