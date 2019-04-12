<?php 
	$host = "localhost";
	$user = "root";
	$password = "mysql";
	$dbname = "Planningstool";
	$spel_id = $_GET["number"];
	$inputCount = 1;
	$players = [];
	$awnsers = [];
	$errors = 0;
	$Err = [];
	$ErrTijd = "";
	$ErrUitleg = "";
	$Correct = false;
	$Incorrect = false;
	$tijd = "";
	$uitlegger = "";
	$spelers = [];

	//Set DSN (DateSourceName)
	$dsn = "mysql:host=". $host .";dbname=" . $dbname;

	//create a PDO instance (conection)
	$pdo = new PDO($dsn, $user, $password);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

	$sql = "SELECT * FROM Ingeplande_Games LEFT JOIN games ON GameId=games.id";
	$statement = $pdo->prepare($sql);
	$statement->execute(["id" => $gameInfo["GameId"]]); 
	$post = $statement->fetch();

	$players = explode(", ", $post["Players"]);
	$tijd = $post["Start"];
	$uitlegger = $post["Uitlegger"];

	while ($inputCount <= $post["max_players"]){
		array_push($players, $inputCount);
		array_push($awnsers, $inputCount);
		$inputCount++;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (empty($_POST["tijd"])){
			$ErrTijd = "Je moet iets invullen";
			$errors++;
		}else{
			$tijd = test_input($_POST["tijd"]);
			if(!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/",$tijd)){
				    $ErrTijd = "Je hebt geen correct tijdstip ingevuld (13:40).";
				    $errors++;
			}
		}
		if (empty($_POST["uitlegger"])){
			$ErrUitleg = "Je moet iets invullen";
			$errors++;
		}else{
			$uitlegger = test_input($_POST["uitlegger"]);
			if(!preg_match("/^[a-zA-Z ]*?$/",$uitlegger)){
				    $ErrUitleg = "Je mag alleen letters en witruimte gebruiken.";
				    $errors++;
			}
		}
		$totalInvalidPlayers = 0;
		foreach ($awnsers as $key => $awnserValue) {
			if (empty($_POST[$key])){
			    $Err[$key] = "Je moet iets invullen";
			    $errors++;
			    $totalInvalidPlayers++;
			}else{
				$awnsers[$key] = test_input($_POST[$key]);
				if(!preg_match("/^[a-zA-Z ]*$/",$_POST[$key])){
				    $Err[$key] = "Je mag alleen letters en witruimte gebruiken.";
				    $errors++;
				    $totalInvalidPlayers++;
				}else{
					//array_push($spelers, $_POST[$key]);
					$spelers[$key] = $_POST[$key];
				}
			}
		}
		
		if ($totalInvalidPlayers <= ($post["max_players"] - $post["min_players"])){
			foreach ($awnsers as $key => $awnserValue) {
				if (empty($_POST[$key])){
			    $Err[$key] = "";
			    $errors--;
			}else{
				$awnsers[$key] = test_input($_POST[$key]);
				if(!preg_match("/^[a-zA-Z ]*$/",$_POST[$key])){
				    $Err[$key] = "";
				    $errors--;
				}
			}
				
			}
		}
		if($errors == 0){
			$Correct = true;

			$sql2 = "UPDATE Ingeplande_Games SET Start = :start, Uitlegger = :uitlegger, Players = :players WHERE spel_id = :spel_id";
			$statement2 = $pdo->prepare($sql2);
			$statement2->execute(["start" => $tijd, "uitlegger" => $uitlegger, "players" => implode(", ", $spelers), "spel_id" => $spel_id]);
		}else{
			$Incorrect = true;
		}
	}
	

	function test_input($data) {
	  $data = trim($data); //Zorgt ervoor dat onnodige space, tab, newline worden weggehaald.
	  $data = stripslashes($data); //verwijderd backslashes (\).
	  $data = htmlspecialchars($data); //Dit zorgt ervoor dat speciale karakters naar html veranderd waardoor je niet gehackt kan worden.
	  return $data;
    }
?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../CSS/index.css">
	<link rel="stylesheet" type="text/css" href="../CSS/detail.css">
	<link rel="stylesheet" type="text/css" href="../CSS/navBar.css">
	<meta charset="utf-8">
	<title>Planningstool</title>
</head>
<body>
	<?php include "../HTML/navBar.html"; ?>
	<div class="placeFillerExtension" id="placefiller">
		
	</div>
	<?php if ($Correct == true) { ?>
		<p class="toegevoegt">Update voltooit</p>
	<?php } ?>
	<?php if ($Incorrect == true) { ?>
		<p class="mislukt">Update mislukt</p>
	<?php } ?>
	<div class="block">
		<h1 class="title"> <?php echo $post["name"] ?></h1>
		<img class="gameImage" src="../../Aangeleverd/Opdracht/afbeeldingen/<?php echo $post["image"] ?>">
		<div class="text"><?php echo $post["description"] ?></div>
	</div>
	<div class="block blockExtension">
		<h1 class="extraInfo">Extra info</h1>
		<p class="extraInfo">Skills: <?php echo $post["skills"] ?></p>
		<p class="extraInfo">Min spelers: <?php echo $post["min_players"] ?></p>
		<p class="extraInfo">Max spelers: <?php echo $post["max_players"] ?></p>
		<p class="extraInfo">Tijdsduur: <?php echo $post["play_minutes"] ?> minuten</p>
		<p class="extraInfo">Tijdsduur intro: <?php echo $post["explain_minutes"] ?> minuten</p>
		<?php if ($post["expansions"] != null) { ?>
			<P class="extraInfo">Expansions: <?php echo $post["expansions"] ?></P>
		<?php } ?>
		<a class="link" href="<?php echo $post["url"] ?>" target="blank">Link: <?php echo $post["url"] ?></a>
	</div>
	<div class="block">
		<div class="youtube"><?php echo $post["youtube"] ?></div>
	</div>
	<div class="block">
		<form method="POST">
			<div class="inputBox">
				<p>Begin tijd</p>
				<input class="input" type="text" name="tijd" placeholder="00:00" value="<?php echo isset($_POST["tijd"]) ? $_POST["tijd"]  : $tijd ?>">
				<span class="error"><?php echo $ErrTijd;?></span>
			</div>
			<?php foreach ($players as $key => $value) { ?>
			<div class="inputBox">
				<p>Naam speler <?php echo $key+1 ?></p>
				<input class="input" type="text" name="<?php echo $key ?>" value="<?php echo isset($_POST[$key]) ? $_POST[$key]  : (!is_numeric($value) ? $value : "") ?>">
				<span class="error"><?php echo $Err[$key];?></span>
			</div>
			<?php };?>
			<div class="inputBox">
				<p>Uitlegger</p>
				<input class="input" type="text" name="uitlegger" placeholder="Naam uitlegger" value="<?php echo isset($_POST["uitlegger"]) ? $_POST["uitlegger"]  : $uitlegger ?>">
				<span class="error"><?php echo $ErrUitleg;?></span>
			</div>
			<div class="bevestig">
				<input id="submit" type="submit" value="Bevestigen">
			</div>
		</form>
	</div>
	<?php include "../HTML/Footer.html"; ?>
</body>
</html>