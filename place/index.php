<html>
	<head>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="/css/materialize.css" media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Reddit Place - moustacheminer.com</title>
		<meta name="description" content="A web interface that allows you to recall your or other's past placed pixels.">
		<style>
			.parallax-container {
				height: 100%;
				width: 100%;
			}

			.background {
				opacity: 0.3;
			}

			h1 {
				font-size: 6vw;
				margin-left: auto;
				margin-right: auto;
			}

			body {
				background-color: #FFFFFF;
			}

			footer {
				width: 100%
			}
		</style>
	</head>
	<body>
		<nav class="light-blue lighten-1" >
			<div class="nav-wrapper container">
				<div class="brand-logo">moustacheminer</div>
				<a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul class="side-nav" id="side-nav">
					<li><a href="https://www.gnu.org/licenses/gpl-3.0.en.html">GNU GPL v3</a></li>
					<li class="no-padding">
						<ul class="collapsible collapsible-accordion">
							<li>
								<a class="collapsible-header">MSS-Discord<i class="material-icons">arrow_drop_down</i></a>
								<div class="collapsible-body">
									<ul>
										<li><a href="https://discordapp.com/oauth2/authorize?&client_id=257547382277931009&scope=bot&permissions=70765632">Invite Bot</a></li>
										<li><a href="https://discord.gg/hPw5gEt">MSS Chat</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</li>
					<li class="no-padding">
						<ul class="collapsible collapsible-accordion">
							<li>
								<a class="collapsible-header">Reddit<i class="material-icons">arrow_drop_down</i></a>
								<div class="collapsible-body">
									<ul>
										<li><a href="/place/">/r/place User Logs</a></li>
										<li><a href="/place/export.csv">/r/place Exports (CSV)</a></li>
										<li><a href="http://reddit.moustacheminer.com">April Fools Forever</a></li>
										<li><a onclick="chrome.webstore.install('https://chrome.google.com/webstore/detail/hcjalmlcbgeieaddjghjbkdiegpigbnk')">RES for Google Chrome</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="nav-wrapper container">
				<ul class="side-nav" id="github">
					<li><a href="https://github.com/moustacheminer" class="subheader">moustacheminer @ GitHub</a></li>
					<li><a href="https://github.com/moustacheminer/moustacheminer.github.io">moustacheminer.github.io</a></li>
					<li><a href="https://github.com/moustacheminer/mss-discord">MSS-Discord</a></li>
					<li><a href="https://github.com/moustacheminer/mss-garrysmod">MSS-GarrysMod</a></li>
					<li><a href="https://github.com/moustacheminer/place">/r/place Capture</a></li>
					<li><div class="divider"></div></li>
					<li><a href="https://github.com/lepon01" class="subheader">7coil @ GitHub</a></li>
					<li><a href="https://github.com/lepon01/pbblbkmchat">Pebble Watch Chat</a></li>
				</ul>
			</div>
		</nav>
		<main>
		<div class="container">
			<br><br>
			<h1 class="center teal-text text-lighten-2">Reddit Place User Search</h1>
			<form method="get">
				<div class="row">
					<div class="input-field col s12">
						<input type="text" name="username" id="username">
						<label for="username">Reddit Username</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s4">
						<select name="colour">
							<option value="" disabled selected>Select a Colour</option>
							<option value="0">White</option>
							<option value="1">Light Grey</option>
							<option value="2">Grey</option>
							<option value="3">Black</option>
							<option value="4">Pink</option>
							<option value="5">Red</option>
							<option value="6">Orange</option>
							<option value="7">Brown</option>
							<option value="8">Yellow</option>
							<option value="9">Lime</option>
							<option value="10">Green</option>
							<option value="11">Cyan</option>
							<option value="12">Blue</option>
							<option value="13">Dark Blue</option>
							<option value="14">Magenta</option>
							<option value="15">Purple</option>
						</select>
						<label>Colour</label>
					</div>
					<div class="input-field col s4">
						<input type="number" name="x" id="x" class="validate">
						<label for="x" data-error="The value is not between XXX and YYY.">X Coordinate</label>
					</div>
					<div class="input-field col s4">
						<input type="number" name="y" id="y" class="validate">
						<label for="y" data-error="The value is not between XXX and YYY.">Y Coordinate</label>
					</div>
				</div>
					<button class="btn waves-effect waves-light" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
			</form>
			<?php
				if(isset($_GET['username']) || isset($_GET['x']) || isset($_GET['y']) || isset($_GET['colour']) ) {
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

					$username = base64_encode(sha1(mysqli_real_escape_string($conn, $_GET['username'])), true);
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

					$sql = "SELECT * FROM tile_placements";
					if ($where_string) {
						$sql .= " WHERE " . $where_string;
					}

					$result = $conn->query($sql) or die($conn->error);

					echo "<p>Ran query $sql</p>";

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
							case 0:
								$colour = "White";
								break;
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
			<br><br>
		</div>
		</main>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="/js/materialize.min.js"></script>
		<script type="text/javascript" src="/js/init.js"></script>
		<footer class="page-footer light-blue lighten-1">
			<div class="container">
				<div class="row">
					<div class="col s12">
						<p class="grey-text text-lighten-4">Serving servers so sadly, some servers serving server services serve sick server serving servers.</p>
					</div>
				</div>
			</div>
			<div class="footer-copyright light-blue">
				<div class="container">
					&#169 2015 - 2017 moustacheminer.com
				</div>
			</div>
		</footer>
		<script>
			$(".btn-large").sideNav();
			$(".github").sideNav();

			$('.collapsible').collapsible({
				accordion : true
			});

			$(document).ready(function() {
				$('select').material_select();
			});
		</script>
	</body>
</html>
