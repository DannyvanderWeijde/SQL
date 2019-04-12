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

	$spel_id = $_GET["number"];
	$sql = "DELETE FROM Ingeplande_Games WHERE spel_id = :spel_id";
	$statement = $pdo->prepare($sql);
	$statement->execute(["spel_id" => $spel_id]);
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
	<div class="placeFillerExtension" id="placefiller">
		
	</div>
	<div class="block">
		<h1 class="itemDeleted">Item verwijverd!</h1>
	</div>
	<?php include "../HTML/Footer.html"; ?>
</body>
</html>