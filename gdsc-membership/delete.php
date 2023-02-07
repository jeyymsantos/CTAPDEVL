<?php
require 'connection.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];

    if(!empty($_POST['email']) && !empty($_POST['apiKey'])){
        if($con){
            $sql = "SELECT * FROM gdsc WHERE email = '$email' AND apiKey = '$apiKey'";
            $res = mysqli_query($con, $sql);
    
            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_assoc($res);
                $sqlDelete = "DELETE FROM gdsc WHERE email = '$email' AND apiKey = '$apiKey'";
    
                if(mysqli_query($con, $sqlDelete)){
                    echo 'success';
                }else{
                    echo 'failed';
                }
            }else{
                echo 'Unauthorized Access';
            }
        }else{
            echo 'Database Connection Failed';
        }
    }else{
        echo 'All fields are required!';
    }
}
?>