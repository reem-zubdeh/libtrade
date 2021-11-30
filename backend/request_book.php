<?php

include("connection.php");

$results = array(
	"complete" => true,
	"valid" => true,
	"success" => true,
    "available" => true
);

if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){
	
    $user_id = $_POST["user_id"];

	$query = "SELECT * from users WHERE user_id = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("d", $user_id);
	$stmt->execute();
	$uniqueres = $stmt->get_result();
	$row = $uniqueres->fetch_assoc();
	if(empty($row)) {
		$results["valid"] = false;
		$json = json_encode($results);
		header('Content-Type: application/json');
		print $json;
		exit();
	}

}
else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["requesting_user_id"]) && $_POST["requesting_user_id"] != ""){
	
    $requesting_user_id = $_POST["requesting_user_id"];

	$query = "SELECT * from users WHERE user_id = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("d", $requesting_user_id);
	$stmt->execute();
	$uniqueres = $stmt->get_result();
	$row = $uniqueres->fetch_assoc();
	if(empty($row)) {
		$results["valid"] = false;
		$json = json_encode($results);
		header('Content-Type: application/json');
		print $json;
		exit();
	}

}
else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["book_id"]) && $_POST["book_id"] != ""){
	
    $book_id = $_POST["book_id"];

	$query = "SELECT * from owned_books WHERE user_id = ? AND book_id = ? AND available = 1";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("dd", $user_id, $book_id);
	$stmt->execute();
	$uniqueres = $stmt->get_result();
	$row = $uniqueres->fetch_assoc();
	if(empty($row)) {
		$results["available"] = false;
		$json = json_encode($results);
		header('Content-Type: application/json');
		print $json;
		exit();
	}

}

else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["requesting_book_id"]) && $_POST["requesting_book_id"] != ""){
	
    $requesting_book_id = $_POST["requesting_book_id"];

	$query = "SELECT * from owned_books WHERE user_id = ? AND book_id = ? AND available = 1";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("dd", $requesting_user_id, $requesting_book_id);
	$stmt->execute();
	$uniqueres = $stmt->get_result();
	$row = $uniqueres->fetch_assoc();
	if(empty($row)) {
		$results["available"] = false;
		$json = json_encode($results);
		header('Content-Type: application/json');
		print $json;
		exit();
	}

}
else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

$date = date("Y-m-d");

$query = "INSERT INTO updates (user_id, requesting_user_id, book_id, requesting_book_id, date) VALUES (?,?,?,?,?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("dddds", $user_id, $requesting_user_id, $book_id, $requesting_book_id, $date);

if (!$stmt->execute()) {
	$results["success"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

$stmt->close();
$connection->close();
$json = json_encode($results);
header('Content-Type: application/json');
print $json;

?>