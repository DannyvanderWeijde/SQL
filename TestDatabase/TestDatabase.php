<?php
	$host = "localhost";
	$user = "root";
	$password = "mysql";
	$dbname = "Test";

	//Set DSN (DateSourceName)
	$dsn = "mysql:host=". $host .";dbname=" . $dbname;

	// create a PDO instance (conection)
	$pdo = new PDO($dsn, $user, $password);
	// if you don't want to give every FETCH an attribute
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
	// This can be overwriten ^
	

	# PRDO QUERY

	// $statement = $pdo->query("SELECT * FROM Tabel");
	
	// while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
	// 	echo $row["name"] . "<br>";
	// }

	// while ($row = $statement->fetch(PDO::FETCH_OBJ)){
	// 	echo $row->name . "<br>";
	// }	

	// while ($row = $statement->fetch()){
	// 	echo $row->name . "<br>";
	// }


	// FETCHES 
	// PDO::FETCH_ASSOC
	// PDO::FEYCH_BOJ

	// PREPARED STATEMENST (prepare & execute)


	//UNSAFE (People can use code to mess with your database)
	// $sql = "SELECT * FROM Tabel WHERE author = "$author";

	// FETCH MULTIPLE POSTS

	//User Input

	$author = "Danny";
	$id = 1;


	// Positional Params

	// $sql = "SELECT * FROM Tabel WHERE author = ?";
	// $statement = $pdo->prepare($sql);
	// $statement->execute([$author]); 
	// $posts = $statement->fetchAll();


	// Named Params

	// $sql = "SELECT * FROM Tabel WHERE author = :author && id = :id";
	// $statement = $pdo->prepare($sql);
	// $statement->execute(["author" => $author, "id" => $id]); 
	// $posts = $statement->fetchAll();

	// foreach($posts as $post){
	// 	echo $post->name . "<br>";
	// }


	//FETCH SINGLE POST

	// $sql = "SELECT * FROM Tabel WHERE id = :id";
	// $statement = $pdo->prepare($sql);
	// $statement->execute(["id" => $id]); 
	// $post = $statement->fetch();

	// echo $post->body;


	// GET ROW COUNT

	// $statement = $pdo->prepare("SELECT * FROM Tabel WHERE author = ?");
	// $statement->execute([$author]);
	// $postCount = $statement->rowCount();

	// echo $postCount;


	// INSERT DATA

	// $name = "Test 5";
	// $body = "Dit is test vijf";
	// $author = "Willem";

	// $sql = "INSERT INTO Tabel(name,body,author) VALUES(:name, :body, :author)";
	// $statement = $pdo->prepare($sql);
	// $statement->execute(["name" => $name, "body" => $body, "author" => $author]);

	// echo "post added";


	// UPDATE DATA

	// $id = 1;
	// $body = "Dit item is geupdate";

	// $sql = "UPDATE Tabel SET body = :body WHERE
	//  id = :id";
	// $statement = $pdo->prepare($sql);
	// $statement->execute(["body" => $body, "id" => $id]);

	// echo "post updated";


	// DELETE DATA

	// $id = 6;

	// $sql = "DELETE FROM Tabel WHERE id = :id";
	// $statement = $pdo->prepare($sql);
	// $statement->execute(["id" => $id]);

	// echo "post delete";


	// SEARCH DATA
	// $search = "%test%";
	// $sql = "SELECT * FROM Tabel WHERE body LIKE ?";
	// $statement = $pdo->prepare($sql);
	// $statement->execute([$search]);
	// $posts = $statement->fetchAll();

	// foreach($posts as $post){
	// 	echo $post->body . "<br>";
	// }