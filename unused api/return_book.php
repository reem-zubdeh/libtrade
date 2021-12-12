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

if(isset($_POST["trade_id"]) && $_POST["trade_id"] != ""){
	$trade_id = $_POST["trade_id"];

    $query = "SELECT * FROM trades WHERE trade_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("d", $trade_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $uniqueres = $res->fetch_assoc();

    if (!empty($uniqueres) && ($uniqueres["user1_id"] == $user_id || $uniqueres["user2_id"] == $user_id)) {

        


        $trade_id = $uniqueres["trade_id"];
        $query = "DELETE FROM trades WHERE trade_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("d", $trade_id);
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

?>