<?php

include("connection.php");

$results = array(
    "complete" => true,
	"valid" => true,
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

if(isset($_POST["update_id"]) && $_POST["update_id"] != ""){
	$update_id = $_POST["update_id"];

    $query = "SELECT * FROM updates WHERE update_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("d", $update_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $uniqueres = $res->fetch_assoc();
    if (!empty($uniqueres)) {
        $user1_id = $uniqueres["user_id"];
        if ($user1_id != $user_id) {
            $results["valid"] = false;
            $json = json_encode($results);
            header('Content-Type: application/json');
            print $json;
            exit();
        }
        $user2_id = $uniqueres["requesting_user_id"];
        $book1_id = $uniqueres["book_id"];
        $book2_id = $uniqueres["requesting_book_id"];
    }
    else {
        $results["valid"] = false;
        $json = json_encode($results);
        header('Content-Type: application/json');
        print $json;
        exit();
    }
    

}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["response"]) && $_POST["response"] != ""){
	$response = $_POST["response"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if ($response) {

    $date = date("Y-m-d");
	$query = "INSERT INTO trades (user1_id, user2_id, book1_id, book2_id, date) VALUES (?,?,?,?,?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("dddds", $user1_id, $user2_id, $book1_id, $book2_id, $date);
    if (!$stmt->execute()) {
        $results["success"] = false;
        $json = json_encode($results);
        header('Content-Type: application/json');
        print $json;
        exit();
    }    

    $query = "UPDATE owned_books SET available = 0 WHERE user_id = ? AND book_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("dd", $user1_id, $book1_id);

    if (!$stmt->execute()) {
        $results["success"] = false;
        $json = json_encode($results);
        header('Content-Type: application/json');
        print $json;
        exit();
    }

    $query = "UPDATE owned_books SET available = 0 WHERE user_id = ? AND book_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("dd", $user2_id, $book2_id);

    if (!$stmt->execute()) {
        $results["success"] = false;
        $json = json_encode($results);
        header('Content-Type: application/json');
        print $json;
        exit();
    }

}

$query = "DELETE FROM updates WHERE user_id = ? AND book_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("dd", $user1_id, $book1_id);
if (!$stmt->execute()) {
    $results["success"] = false;
}
$stmt->close();
$connection->close();
$json = json_encode($results);
header('Content-Type: application/json');
print $json;
exit();

?>