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

	$statement = $pdo->query("SELECT * FROM Ingeplande_Games LEFT JOIN games ON GameId=games.id ORDER BY Start");
?>
<!DOCTYPE html>
<html lang="nl">
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../CSS/index.css">
	<link rel="stylesheet" type="text/css" href="../CSS/navBar.css">
	<meta charset="utf-8">
	<title>Planningstool</title>
</head>
<body>
	<?php include "../HTML/navBar.html"; ?>
	<div id="placefiller">
		
	</div>
	<div id="image">
		
	</div>
	<div id="title">
		<h2>Planning</h2>
	</div>
	<div id="grid">
		<?php while ($row = $statement->fetch()){ ?>
		<div class="hourField">
			<h1 class="column1"><?php echo $row["Start"]?></h1>
			<p class="column2">Spel</p>
			<p class="column3">Tijdsduur</p>
			<p class="column4">Uitlegsduur</p>
			<p class="column5">Uitlegger</p>
			<p class="column6">Spelers</p>
			<a class="column2" href="detail.php?number=<?php echo $row["id"]?>"><?php echo $row["name"]?></a>
			<p class="column3"><?php echo $row["play_minutes"]?> min</p>
			<p class="column4"><?php echo $row["explain_minutes"]?> min</p>
			<p class="column5"><?php echo $row["Uitlegger"]?></p>
			<p class="column6"><?php echo $row["Players"]?></p>
			<a href="Update.php?number=<?php echo $row["spel_id"]?>"><i class="edit far fa-edit"></i></a>
			<a href="Warning.php?number=<?php echo $row["spel_id"]?>"><i class="delete fas fa-trash-alt"></i></a>
		</div>
		<?php } ?>
	</div>
	<?php include "../HTML/Footer.html"; ?>
</body>
</html>