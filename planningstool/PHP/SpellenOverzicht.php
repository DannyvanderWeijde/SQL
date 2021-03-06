<?php 
	$host = "localhost";
	$user = "root";
	$password = "mysql";
	$dbname = "Planningstool";

	//Set DSN (DateSourceName)
	$dsn = "mysql:host=". $host .";dbname=" . $dbname;

	// create a PDO instance (conection)
	$pdo = new PDO($dsn, $user, $password);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

	$statement = $pdo->query("SELECT * FROM games");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../CSS/index.css">
	<link rel="stylesheet" type="text/css" href="../CSS/SpellenOverzicht.css">
	<link rel="stylesheet" type="text/css" href="../CSS/navBar.css">
	<meta charset="utf-8">
	<title>Planningstool</title>
</head>
<body>
	<?php include "../HTML/navBar.html"; ?>
	<div class="placeFillerExtension" id="placefiller">
		
	</div>
	<div class="gameOverview">
		<?php while ($row = $statement->fetch()){ ?>
		<div class="gameOverviewDetails">
			<a href="detail.php?number=<?php echo $row["id"]?>"><div class="detailLink"></div></a>
			<img class="gameImages" src="../../Aangeleverd/Opdracht/afbeeldingen/<?php echo $row["image"] ?>">
			<h3><?php echo $row["name"]?></h3>
			<p>min spelers: <?php echo $row["min_players"] ?></p>
			<p>max spelers: <?php echo $row["max_players"] ?></p>
			<p>tijdsduur: <?php echo $row["play_minutes"] ?> min</p>
			<p>intro tijd: <?php echo $row["explain_minutes"] ?> min</p>
		</div>
		<?php } ?>
	</div>
	<?php include "../HTML/Footer.html"; ?>
</body>
</html>