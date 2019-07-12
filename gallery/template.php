<?php
$mysqli = new mysqli('localhost', 'root', '', 'kowalonek');
$query = "SELECT * FROM gallery order by id";
if($result = $mysqli->query($query)){
    while($r = $result->fetch_assoc()){
        echo '<img src="data:image/png;base64,' . base64_encode($r['name']) . '" />'; 
    }
}
$result->free();
?>
