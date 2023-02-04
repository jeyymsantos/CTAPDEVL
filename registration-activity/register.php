<?php
require 'connection.php';

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if(!$con){
        echo "Database connection failed";
    }else{
        $sql = "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')";
        if(mysqli_query($con, $sql)){
            echo "success";
        }else{
            echo "Registration Failed";
        }
    } 
}else{
    echo "All fields are required!";
}






?>