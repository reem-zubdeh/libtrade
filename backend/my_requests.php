<?php

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


$query = "SELECT `update_id`, `first_name`, `last_name`, `date` 
FROM `updates` JOIN `users` ON `updates`.`requesting_user_id` = `users`.`user_id` WHERE `updates`.`user_id` = ?";
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
header('Content-Type: application/json');
print $json;
exit();


?>