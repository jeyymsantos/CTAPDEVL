<?php

require 'connection.php';

$result = array();

$sql = "SELECT * FROM users";
$res = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($res)){
    $result[] = $row;
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>