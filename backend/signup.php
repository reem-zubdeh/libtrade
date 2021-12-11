<?php

include("connection.php");

$results = array(
	"complete" => true,
	"unique" => true,
	"valid" => true,
	"success" => true
);

if(isset($_POST["email"]) && $_POST["email"] != ""){
	$email = $_POST["email"];

	$query = "SELECT * from users WHERE email = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$uniqueres = $stmt->get_result();
	$row = $uniqueres->fetch_assoc();
	if(!empty($row)) {
		$results["unique"] = false;
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

if(isset($_POST["first-name"]) && $_POST["first-name"] != ""){
	$first_name = $_POST["first-name"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["last-name"]) && $_POST["last-name"] != ""){
	$last_name = $_POST["last-name"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["password"]) && $_POST["password"] != ""){
	$password = hash("sha256", $_POST["password"]);
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["phone-no"]) && $_POST["phone-no"] != ""){
	$phone_no = $_POST["phone-no"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["location"]) && $_POST["location"] != ""){
	$location = $_POST["location"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
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

} else {
	$image_filename = "default.png";
}

$query = "INSERT INTO users (email, password, first_name, last_name, phone_no, location, image_filename) VALUES (?,?,?,?,?,?,?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssssss", $email, $password, $first_name, $last_name, $phone_no, $location, $image_filename);

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