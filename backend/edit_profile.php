<?php

include("connection.php");

$results = array(
	"valid" => true,
	"success" => true,
	"login" => true
);

$changed = array(
	"first-name" => false,
	"last-name" => false,
	"phone-no" => false,
	"location" => false,
	"image" => false
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

if(isset($_POST["first-name"]) && $_POST["first-name"] != ""){
	$first_name = $_POST["first-name"];
    $changed["first-name"] = true;
}

if(isset($_POST["last-name"]) && $_POST["last-name"] != ""){
	$last_name = $_POST["last-name"];
    $changed["last-name"] = true;
}

if(isset($_POST["phone-no"]) && $_POST["phone-no"] != ""){
	$phone_no = $_POST["phone-no"];
    $changed["phone-no"] = true;
}

if(isset($_POST["location"]) && $_POST["location"] != ""){
	$location = $_POST["location"];
    $changed["location"] = true;
}

if (array_key_exists("image", $_FILES) && isset($_FILES["image"]) && $_FILES["image"]["error"] != UPLOAD_ERR_NO_FILE) {

    $image_filename = (str_replace(".", "", microtime(true))); //make file name unix time with microseconds
	$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
	$image_filename = $image_filename . "." . $ext;

	$tempname = $_FILES["image"]["tmp_name"];
    $folder = __DIR__ ."\\profile_images\\".$image_filename;
	
	$mime = mime_content_type($tempname);
	$type = substr($mime, 0, strpos($mime, "/")); //make sure file uploaded is image
	
	if ((strcasecmp($type, "image") == 0)) {
		if (!move_uploaded_file($tempname, $folder))  {
			$results["success"] = false;
			$json = json_encode($results);
			header('Content-Type: application/json');
			print $json;
			exit();
		}
	}
	else {
		$results["valid"] = false;
		$json = json_encode($results);
		header('Content-Type: application/json');
		print $json;
		exit();
	}

    $changed["image"] = true;

}

$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

if (!$changed["first-name"]) $first_name = $row["first_name"];
if (!$changed["last-name"]) $last_name = $row["last_name"];
if (!$changed["phone-no"]) $phone_no = $row["phone_no"];
if (!$changed["location"]) $location = $row["location"];
if (!$changed["image"]) $image_filename = $row["image_filename"];


$query = "UPDATE users SET first_name = ?, last_name = ?, phone_no = ?, location = ?, image_filename = ? WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssssd", $first_name, $last_name, $phone_no, $location, $image_filename, $user_id);

if (!$stmt->execute()) {
	$results["success"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

$stmt->close();
$connection->close();
$json = json_encode($results);
header('Content-Type: application/json');
print $json;

?>