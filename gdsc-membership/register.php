<?php
require 'connection.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sex = $_POST['sex'];
    $section = $_POST['section'];

    if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($sex) && !empty($section)){
        $sql = "INSERT INTO gdsc (firstName, lastName, email, password, sex, section)
        VALUES ('$firstName', '$lastName', '$email', '$password', '$sex', '$section')";
    
        if(mysqli_query($con, $sql)){
            echo "success";
        }else{
            echo "Registration failed!";
        }
    }else{
        echo "All fields are required!";
    }

    
}

?>