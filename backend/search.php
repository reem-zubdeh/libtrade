<?php

header('Access-Control-Allow-Origin: *');

include("connection.php");

if(isset($_GET["q"]) && $_GET["q"] != ""){
	$q = $_GET["q"] . "%";
}else{
	$res = [];
	$json = json_encode($res);
	header('Content-Type: application/json');
	print $json;
	exit();
}

$query = "SELECT *, COUNT(`book_id`) AS `number_owned` FROM
(SELECT `books`.`book_id`, `title`, `author`, `image_filename` from `books` JOIN `owned_books` ON `books`.`book_id` = `owned_books`.`book_id` AND (`title` LIKE ? OR `author` LIKE ?))
AS `available_books`
GROUP BY `book_id`";

$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $q, $q);
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