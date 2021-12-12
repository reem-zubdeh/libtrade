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


$query = "SELECT trade_id, first_name, last_name, date
FROM `trades` JOIN `users` ON user1_id = user_id WHERE user2_id = ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$rows1 = [];
while($r = $res->fetch_assoc()) {
    $rows1[] = $r;
}

$query = "SELECT trade_id, first_name, last_name, date
FROM `trades` JOIN `users` ON user2_id = user_id WHERE user1_id = ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$rows2 = [];
while($r = $res->fetch_assoc()) {
    $rows2[] = $r;
}

$results = array_merge($rows1, $rows2);

$stmt->close();
$json = json_encode($results, JSON_NUMERIC_CHECK);
header('Content-Type: application/json');
print $json;
exit();


?>