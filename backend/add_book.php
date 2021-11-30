<?php

include("connection.php");

$results = array(
	"complete" => true,
	"unique" => true,
	"valid" => true,
	"success" => true,
	"login" => true,
	"new" => true
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

if(isset($_POST["title"]) && $_POST["title"] != ""){
	$title = $_POST["title"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

if(isset($_POST["author"]) && $_POST["author"] != ""){
	$author = $_POST["author"];
}else{
	$results["complete"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

	$query = "SELECT * from books WHERE title = ? AND author = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("ss", $title, $author);
	$stmt->execute();
	$uniqueres = $stmt->get_result();
	$stmt->close();
	$row = $uniqueres->fetch_assoc();
	if(!empty($row)) { //check if book exists in database to see if insert is necessary
		$results["new"] = false;
		$book_id = $row["book_id"];
		$query = "SELECT * from owned_books WHERE book_id = ? AND user_id = ?"; 
		$stmt = $connection->prepare($query);
		$stmt->bind_param("dd", $book_id, $user_id);
		$stmt->execute();
		$uniqueres = $stmt->get_result();
		$stmt->close();
		$row = $uniqueres->fetch_assoc();

		if(!empty($row)) { //check if user already has book
			$results["unique"] = false;
			$json = json_encode($results);
			header('Content-Type: application/json');
			print $json;
			exit();
		}
	} else {
		
		if (array_key_exists("image", $_FILES) && isset($_FILES["image"]) && $_FILES["image"]["error"] != UPLOAD_ERR_NO_FILE) {

			$filename = (str_replace(" ", "", $title ."_". $author));
			$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
			$filename = $filename . "." . $ext;
		
			$tempname = $_FILES["image"]["tmp_name"];
			$folder = __DIR__ ."\\book_images\\".$filename;
			
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
			$results["complete"] = false;
			$json = json_encode($results);
			header('Content-Type: application/json');
			print $json;
			exit();
		}

		$query = "INSERT INTO books (title, author, image_filename) VALUES (?,?,?)";
		$stmt = $connection->prepare($query);
		$stmt->bind_param("sss", $title, $author, $filename);

		if (!$stmt->execute()) {
			$results["success"] = false;
			$json = json_encode($results);
			header('Content-Type: application/json');
			print $json;
			exit();
		}

		$query = "SELECT * from books WHERE title = ? AND author = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param("ss", $title, $author);
		$stmt->execute();
		$res = $stmt->get_result();
		$stmt->close();
		$row = $res->fetch_assoc();
		$book_id = $row["book_id"];


	}


$query = "INSERT INTO owned_books (book_id, user_id, available, reading) VALUES (?,?,1,0)";
$stmt = $connection->prepare($query);
$stmt->bind_param("dd", $book_id, $user_id);

if (!$stmt->execute()) {
	echo $stmt->error;
	$results["success"] = false;
	$json = json_encode($results);
	header('Content-Type: application/json');
	print $json;
	exit();
}

$connection->close();
$json = json_encode($results);
header('Content-Type: application/json');
print $json;

?>