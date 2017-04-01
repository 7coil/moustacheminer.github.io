<html>
	<head>
		<title>Reddit Place</title>
		<link rel="stylesheet" href="place.css">
	</head>
	<body>
		<h1>Reddit Place User Count</h1>
		<p>See what colours people have submitted (since Fri Mar 31 2017 20:26:06 GMT+0100)</p>
		<a href="https://github.com/moustacheminer/place">GitHub code, csv and Microsoft Excel Document</a>
		<a href="/place/">Back to search</a>
		<?php
			echo "Searching...<br>";
			$servername = "127.0.0.1";
			$serveruser = "reddit";
			$serverpass = "redditsips";
			$db = "reddit";

			$conn = new mysqli($servername, $serveruser, $serverpass, $db);

			if($conn->connect_errno > 0){
				echo("Error!<br>");
				die('Unable to connect to database [' . $conn->connect_error . ']');
			}

			echo "Connected to mySQL<br>";

			$sql = "SELECT username,COUNT(*) as count FROM place GROUP BY username ORDER BY count DESC LIMIT 100;";
			$result = $conn->query($sql) or die($conn->error);

			echo "<table border='1px'>";
			echo "<tr>";
			echo "<th>Username</th>";
			echo "<th>Count</th>";
			echo "</tr>";

			while($row = $result->fetch_assoc()){
				$userurl = "http://moustacheminer.com/place/?username=" . urlencode($row['username']);

				echo "<tr>";
				echo "<td><a href='" . $userurl . "'>" . $row['username'] . '</a></td>';
				echo "<td>" . $row['count'] . '</td>';
				echo "</tr>";
			}

			echo "</table>";

			$conn->close();
		?>
		<hr>
		<i>moustacheminer.com - Copyright 2002, All rights reserved</i>
	</body>
</html>
