<?php
session_start();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUploadPhoto"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUploadPhoto"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUploadPhoto"]["tmp_name"], $target_file)) {
        
        
        // $nameOfFile = basename( $_FILES["fileToUploadPhoto"]["name"]);
        //  $imagedata = file_get_contents($_FILES["fileToUploadPhoto"]["name"]);
        //  $path = 'uploads/IMG_20161012_150341.jpg';
        //  $type = pathinfo($path, PATHINFO_EXTENSION);
        //  $data = file_get_contents($path);

        // $base64 = base64_decode($data);
        
        $category = $_POST['categoryPhoto'];
   //     echo "The file ". $nameOfFile. " has been uploaded.";

        $con = mysqli_connect("localhost", "root", "", "pilkarze");
        //echo "INSERT INTO gallery (name, category) VALUES ('".$data."', $category)";
        $upload = mysqli_escape_string($con,file_get_contents($target_file));
        $public = 0;
        if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
            $public = 1;
        }
        mysqli_query($con, "INSERT INTO gallery (name, category, public) VALUES ('".$upload."', $category, $public)");
    
    
    
        echo "The file ". basename( $_FILES["fileToUploadPhoto"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>