<?php

include("connection.php");

if(isset($_POST["email"]) && $_POST["email"] != ""){
	$email = $_POST["email"];
}else{
	die("Required fields must be filled");
}

if(isset($_POST["first-name"]) && $_POST["first-name"] != ""){
	$first_name = $_POST["first-name"];
}else{
	die("Required fields must be filled");
}

if(isset($_POST["last-name"]) && $_POST["last-name"] != ""){
	$last_name = $_POST["last-name"];
}else{
	die("Required fields must be filled");
}

if(isset($_POST["password"]) && $_POST["password"] != ""){
	$password = hash("sha256", $_POST["password"]);
}else{
	die("Required fields must be filled");
}

if(isset($_POST["phone-no"]) && $_POST["phone-no"] != ""){
	$phone_no = $_POST["phone-no"];
}else{
	die("Required fields must be filled");
}

if(isset($_POST["location"]) && $_POST["location"] != ""){
	$location = $_POST["location"];
}else{
	die("Required fields must be filled");
}

if (isset($_POST["image"])) {
  
    $filename = (str_replace(".", "", microtime(true)));
    //make file name unix time with microseconds
    $tempname = $_FILES["image"]["tmp_name"];    
    $folder = "profile_images/".$filename;
      
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        die("Failed to upload image");
    }
}

$query = "INSERT INTO users (email, password, first_name, last_name, phone_no, location, image_filename) VALUES (?,?,?,?,?,?,?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssssss", $email, $password, $first_name, $last_name, $phone_no, $location, $filename);
$stmt->execute();

$stmt->close();
$connection->close();
$json = json_encode($temp_array);
print $json;

?>