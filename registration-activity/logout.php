<?php

require 'connection.php';

if(!empty($_POST['email']) && !empty($_POST['apiKey'])){
    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];

    if($con){
        $sql = "SELECT * FROM users WHERE email = '$email' AND apiKey = '$apiKey'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) != 0){
            $row = mysqli_fetch_assoc($res);
            $sqlUpdate = "UPDATE users SET apiKey = '' WHERE email = '$email'";

            if(mysqli_query($con, $sqlUpdate)){
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


?>