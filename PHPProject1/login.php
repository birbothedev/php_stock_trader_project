<?php

// some code referenced from Eric Charnesky php lectures

    session_start();
    
    try {
        require_once 'models/database.php';
        require_once 'models/login.php';
        
        $database = new PDO($data_source_name, $username, $password);
        
        $message = "";
        
        if (!isset($_SESSION['is_logged_in'])){
            $_SESSION['is_logged_in'] = false;
        }

        $email_address = htmlspecialchars(filter_input(INPUT_POST, "email_address"));
        $password = htmlspecialchars((filter_input(INPUT_POST, "password")));
        $confirm_password = htmlspecialchars((filter_input(INPUT_POST, "confirm_password")));
        $action = htmlspecialchars(filter_input(INPUT_POST, "action"));
          
        if($action == "logout"){
            $_SESSION = array();
            session_destroy();
        }
        
        if ($action == "login" && $email_address != "" && $password != ""){
            if(login($email_address, $password)){
                $_SESSION['is_logged_in'] = true;
                // send user to home page after succesfully logging in
                header("Location: index.php");
            } else {
                $message = "Login failed, please try again.";
            }
        }
        
        //added signup so only one hash is created and it matches the database
        if ($action == "sign_up" && $email_address != "" && $password != ""){
            if($password == $confirm_password){
                sign_up($email_address, $password);
            } else {
                echo "Passwords do not match, please try again!";
            }
        }

        include('views/loginview.php');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
    
  
?>