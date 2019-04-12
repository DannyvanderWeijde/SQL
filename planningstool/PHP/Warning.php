<?php 
	$spel_id = $_GET["number"];
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
	<div class="block warning">
		<p>Weet u zeker dat u dit item wilt verwijderen?</p>
		<div class="button"><a href="Delete.php?number=<?php echo $spel_id ?>">Ja</a></div>
		<div class="button"><a href="index.php">Nee</a></div>
	</div>
	<?php include "../HTML/Footer.html"; ?>
</body>
</html>