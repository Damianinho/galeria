<?php
include('../config.php');
session_start();
$public = " and public = 1 ";
if(isset($_SESSION['username'])){
    $public = "";
}
$mysqli = db();
$select_category = "SELECT * FROM category order by id";
if ($result = $mysqli->query($select_category)) {
    while ($r = $result->fetch_assoc()) {
        $categories[] = $r;
    }
}
$category = isset($_GET['category'])? $_GET['category']: 1;
$query = "SELECT * FROM gallery WHERE category = " . $category . " " .$public. "   order by id";
if ($result = $mysqli->query($query)) {
    while ($r = $result->fetch_assoc()) {
        $photos[] = $r;
    }
    
}
$query = "SELECT * FROM movies WHERE category = " . $category . " " .$public. "   order by id";
if ($result = $mysqli->query($query)) {
    while ($r = $result->fetch_assoc()) {
        $movies[] = $r;
    }
    
}

include('template/list.php');
?>
