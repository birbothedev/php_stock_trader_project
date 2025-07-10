<?php

try {
    require_once 'utility/ensurelogin.php';
    require_once 'models/database.php';
    require_once 'models/users.php';
    
    $database = new PDO($data_source_name, $username, $password);
    
    $action = htmlspecialchars(filter_input(INPUT_POST, "action"));
    
    // INSERT VALUES
    $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
    $email_address = htmlspecialchars(filter_input(INPUT_POST, "email_address"));
    $cash_balance = filter_input(INPUT_POST, "cash_balance", FILTER_VALIDATE_FLOAT);
    
    if ($action == "insert" && $name != "" && $email_address != "" && $cash_balance != 0){
        $user = new User($name, $email_address, $cash_balance);
        insert_user($user);
        header("Location: users.php");
    } else if ($action == "update" && $name != "" && $email_address != "" && $cash_balance != 0){
        $user = new User($name, $email_address, $cash_balance);
        update_user($user);
        header("Location: users.php");
    } else if ($action == "delete" && $name != "" && $email_address != ""){
        $user = new User($name, $email_address, $cash_balance);
        delete_user($user);
        header("Location: users.php");
    } else if ($action != ""){
        $error_message =  "Missing information, please double check all fields before submitting form";
        include('views/error.php');
    }
    
    $users = list_users();
    include('views/users.php');
    
} catch (Exception $e){
    $error_message = $e->getMessage();
    include('views/error.php');
}  
?>
