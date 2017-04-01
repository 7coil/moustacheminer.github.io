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
				font-size: 8vw;
				margin-left: auto;
				margin-right: auto;
			}

			body {
				overflow: hidden;
				background-color: #FFFFFF;
			}

			footer {
				position: fixed;
				bottom: 0;
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
					<li><a href="/place/">/r/place User Logs</a></li>
					<li><a href="/place/export.csv">/r/place Exports (CSV)</a></li>
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
			<a href="#" data-activates="github" class="github"><img style="position: absolute; top: 0; right: 0; border: 0; z-index: 999;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a>
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
		</script>
	</body>
</html>
