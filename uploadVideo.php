<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUploadVideo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $uploadOk = 1;

}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "mp4") {
    echo "Sorry, only MP4 files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUploadVideo"]["tmp_name"], $target_file)) {
        $nameOfFile = basename( $_FILES["fileToUploadVideo"]["name"]);
        $category = $_POST['category'];
        echo "The file ". $nameOfFile. " has been uploaded.";

        $con = mysqli_connect("localhost", "root", "", "kowalonek");
        
        $public = 0;
        if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
            $public = 1;
        }

        
        mysqli_query($con, "INSERT INTO movies (name, category, public) VALUES ('".$nameOfFile."', $category, $public)");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>