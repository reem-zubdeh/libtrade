<?php

include("connection.php");

$json = json_encode(false);

if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){
	$id = $_POST["user_id"];
}else{
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["password"]) && $_POST["password"] != ""){
	$password = hash("sha256", $_POST["password"]);
}else{
	header('Content-Type: application/json');
	print $json;
	exit();
}

$query = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();
$stmt->close();
$connection->close();

if(empty($row)) {
	header('Content-Type: application/json');
	print "{}";
} else {
	$json = json_encode($row);
	header('Content-Type: application/json');
	print $json;
}

?>