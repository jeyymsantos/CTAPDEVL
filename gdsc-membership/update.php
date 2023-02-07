<?php
require 'connection.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $sex = $_POST['sex'];
    $section = $_POST['section'];

    if(!empty($_POST['email']) && !empty($_POST['apiKey']) && !empty($firstName) && !empty($lastName) && !empty($password) && !empty($sex) && !empty($section)){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if($con){
            $sql = "SELECT * FROM gdsc WHERE email = '$email' AND apiKey = '$apiKey'";
            $res = mysqli_query($con, $sql);
    
            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_assoc($res);
                $sqlUpdate = "UPDATE gdsc SET firstName='$firstName', lastName='$lastName', password='$password', section='$section', sex ='$sex' WHERE email = '$email' AND apiKey = '$apiKey'";
    
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
}
?>