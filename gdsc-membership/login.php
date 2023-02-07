<?php
require 'connection.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = array();

    if(!empty($email) && !empty($password)){
   
        if($con){
            $sql = "SELECT * FROM gdsc WHERE email = '$email'";
            $res = mysqli_query($con, $sql);
    
            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_assoc($res);
    
                if($email == $row['email'] && password_verify($password, $row['password'])){
                    try{
                        $apiKey = bin2hex(random_bytes(23));
                    }catch(Exception $e){
                        $apiKey = bin2hex(uniqid($email, true));
                    }
    
                    $sqlUpdate = "UPDATE gdsc SET apiKey = '$apiKey' WHERE email = '$email'";
                    if(mysqli_query($con, $sqlUpdate)){
                        $result = array(
                            "status" => "success",
                            "message" => "Login Successful",
                            "firstName" => $row['firstName'],
                            "lastName" => $row['lastName'],
                            "email" => $row['email'],
                            "section" => $row['section'],
                            "sex" => $row['sex'],
                            "apiKey" => $apiKey
                        );
                    }else{
                        $result = array("status" => "failed", "message" => "Login failed try again");
                    }
                }else{
                    $result = array("status" => "failed", "message" => "Retry with correct email & password");
                }
            }else{
                $result = array("status" => "failed", "message" => "Retry with correct email & password");
            }
        }else{
            $result = array("status" => "failed", "message" => "Databse connection failed");
        }
    }else{
        $result = array("status" => "failed", "message" => "All fields are required");
    }
    
    echo json_encode($result, JSON_PRETTY_PRINT);
    

}
