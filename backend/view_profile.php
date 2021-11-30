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


$query = "SELECT 
user_id,
email,
first_name,
last_name,
phone_no,
location,
image_filename
FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$uniqueres = $res->fetch_assoc();



$stmt->close();
$json = json_encode($uniqueres, JSON_NUMERIC_CHECK);
header('Content-Type: application/json');
print $json;
exit();


?>