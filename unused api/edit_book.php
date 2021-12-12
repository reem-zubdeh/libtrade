<?php

include("connection.php");

$results = array(
	"complete" => true,
	"success" => true,
	"login" => true
);

if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){
	$user_id = $_POST["user_id"];
}else{
	$results["login"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["book_id"]) && $_POST["book_id"] != ""){
	$book_id = $_POST["book_id"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["reading"]) && $_POST["reading"] != ""){
	if ($_POST["reading"] == "on") $reading = 1;
	else $reading = 0;
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["available"]) && $_POST["available"] != ""){
	if ($_POST["available"] == "on") $available = 1;
	else $available = 0;
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["delete"]) && $_POST["delete"] != ""){
	if ($_POST["delete"] == "on") $delete = 1;
	else $delete = 0;
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if ($delete) {
	$query = "DELETE FROM owned_books WHERE user_id = ? AND book_id = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("dd", $user_id, $book_id);
	if (!$stmt->execute()) {
		$results["success"] = false;
	}
	$stmt->close();
	$connection->close();
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}
else {
	$query = "UPDATE owned_books SET reading = ?, available = ? WHERE user_id = ? AND book_id = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("dddd", $reading, $available, $user_id, $book_id);
	if (!$stmt->execute()) {
		$results["success"] = false;
	}
	$stmt->close();
	$connection->close();
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

?>