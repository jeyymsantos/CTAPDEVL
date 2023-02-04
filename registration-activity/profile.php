<?php
require 'connection.php';

if(!empty($_POST['email']) && !empty($_POST['apiKey'])){
    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];
    $result = array(); 

    if($con){
        $sql = "SELECT * FROM users WHERE email = '$email' AND apiKey = '$apiKey'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) != 0){
            $row = mysqli_fetch_assoc($res);
            $result = array(
                "status" => "success",
                "message" => "Data Fetched Successful",
                "name" => $row['name'],
                "email" => $row['email'],
                "apiKey" => $row['apiKey']
            );
        }else{
            $result = array("status" => "failed", "message" => "Unauthorized Access");
        }
    }else{
        $result = array("status" => "failed", "message" => "Databse connection failed");
    }
}else{
    $result = array("status" => "failed", "message" => "All fields are required");
}

echo json_encode($result, JSON_PRETTY_PRINT);
?>