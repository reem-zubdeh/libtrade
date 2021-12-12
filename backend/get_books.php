<?php

header('Access-Control-Allow-Origin: *');

include("connection.php");


if(isset($_GET["user_id"]) && $_GET["user_id"] != ""){
	$user_id = $_GET["user_id"];
}else{
	$res = [];
	$json = json_encode($res);
	header('Content-Type: application/json');
	print $json;
	exit();
}


$query = "SELECT * FROM `books` JOIN `owned_books` ON `books`.`book_id` = `owned_books`.`book_id` WHERE `user_id` = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $user_id);
$stmt->execute();
$res = $stmt->get_result();

$rows = [];
while($r = $res->fetch_assoc()) {
    $rows[] = $r;
}

$stmt->close();
$json = json_encode($rows, JSON_NUMERIC_CHECK);
$json = "{\"books\": " . $json . "}";
header('Content-Type: application/json');
print $json;
exit();


?>