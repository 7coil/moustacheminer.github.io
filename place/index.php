<html>
	<head>
		<title>Reddit Place</title>
		<link rel="stylesheet" href="place.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<h1>Reddit Place User Search</h1>
		<p>See what colours people have submitted (since Fri Mar 31 2017 20:26:06 GMT+0100)</p>
		<a href="https://github.com/moustacheminer/place">GitHub code, csv and Microsoft Excel Document</a>
		<a href="/place/contributions.php">*beta* See the biggest contributors</a>
		<p>Send GET requests to http://moustacheminer.com/place/searchapi?username=(username here)</p>
		<form method="get">
			Username: <input type="text" name="username">
		</form>
		<?php
			if(isset($_GET['username'])) {
				echo "Searching...<br>";
				$servername = "127.0.0.1";
				$serveruser = "reddit";
				$serverpass = "redditsips";
				$db = "reddit";

				$conn = new mysqli($servername, $serveruser, $serverpass, $db);

				$input = mysqli_real_escape_string($conn, $_GET['username']);

				if($conn->connect_errno > 0){
					echo("Error!<br>");
					die('Unable to connect to database [' . $conn->connect_error . ']');
				}

				echo "Connected to mySQL<br>";

				$sql = "SELECT * FROM place WHERE username LIKE '" . $input . "';";
				$result = $conn->query($sql) or die($conn->error);

				echo "<table border='1px'>";
				echo "<tr>";
				echo "<th>ID</th>";
				echo "<th>X</th>";
				echo "<th>Y</th>";
				echo "<th>Username</th>";
				echo "<th>Colour</th>";
				echo "<th>Time (ms)</th>";
				echo "<th>Date</th>";
				echo "</tr>";

				while($row = $result->fetch_assoc()){
					switch($row['colour']) {
						case 1:
							$colour = "Light Grey";
							break;
						case 2:
							$colour = "Grey";
							break;
						case 3:
							$colour = "Black";
							break;
						case 4:
							$colour = "Pink";
							break;
						case 5:
							$colour = "Red";
							break;
						case 6:
							$colour = "Orange";
							break;
						case 7:
							$colour = "Brown";
							break;
						case 8:
							$colour = "Yellow";
							break;
						case 9:
							$colour = "Lime";
							break;
						case 10:
							$colour = "Green";
							break;
						case 11:
							$colour = "Cyan";
							break;
						case 12:
							$colour = "Blue";
							break;
						case 13:
							$colour = "Dark Blue";
							break;
						case 14:
							$colour = "Magenta";
							break;
						case 15:
							$colour = "Purple";
							break;
						default:
							$colour = "Invalid ID";
							break;
					}


					echo "<tr>";
					echo "<td>" . $row['ID'] . '</td>';
					echo "<td>" . $row['x'] . '</td>';
					echo "<td>" . $row['y'] . '</td>';
					echo "<td>" . $row['username'] . '</td>';
					echo "<td>" . $colour . '</td>';
					echo "<td>" . $row['time'] . '</td>';
					echo "<td>" . date("c", $row['time']/1000) . '</td>';
					echo "</tr>";
				}

				echo "</table>";

				$conn->close();
			}
		?>
		<hr>
		<i>moustacheminer.com - Copyright 2002, All rights reserved</i>
	</body>
</html>
