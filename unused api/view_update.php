<?php

include("connection.php");

if(isset($_GET["update_id"]) && $_GET["update_id"] != ""){
	$update_id = $_GET["update_id"];
}else{
	$result = [];
	$json = json_encode($result);
	header('Content-Type: application/json');
	print $json;
	exit();
}

$query = "SELECT * FROM updates WHERE update_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $update_id);
$stmt->execute();
$res = $stmt->get_result();
$uniqueres = $res->fetch_assoc();


$query = "SELECT 
`mine`.`book_id` as my_book_id,
`mine`.`title` as my_title,
`mine`.`author` as my_author,
`mine`.`image_filename` as my_image_filename,
`req`.`book_id` as req_book_id,
`req`.`title` as req_title,
`req`.`author` as req_author,
`req`.`image_filename` as req_image_filename
FROM `books` AS `mine` JOIN `books` AS `req` WHERE `mine`.`book_id` = ? AND `req`.`book_id` = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("dd", $uniqueres["book_id"], $uniqueres["requesting_book_id"]);
$stmt->execute();
$res = $stmt->get_result();
$books = $res->fetch_assoc();

$query = "SELECT user_id, first_name, last_name FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $uniqueres["requesting_user_id"]);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();

$result = array_merge($books, $user);

$stmt->close();
$json = json_encode($result, JSON_NUMERIC_CHECK);
header('Content-Type: application/json');
print $json;
exit();


?>