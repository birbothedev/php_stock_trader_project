<?php


try {
    require_once 'utility/ensurelogin.php';
    require_once 'models/database.php';
    require_once 'models/transactions.php';
    
    $database = new PDO($data_source_name, $username, $password);
    
    $action = htmlspecialchars(filter_input(INPUT_POST, "action"));
    $user_id = filter_input(INPUT_POST, "user_id", FILTER_VALIDATE_INT);
    $symbol = htmlspecialchars(filter_input(INPUT_POST, "symbol"));
    $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_FLOAT);
    
    if ($action == "insert" && $user_id != "" && $symbol != "" && $quantity != 0){
        $transaction = new Transaction($symbol, $quantity, $user_id, $price, $id);
        insert_transaction($transaction);
        header("Location: transactions.php");
    } else if ($action == "update" && $user_id != "" && $symbol != "" && $quantity != 0){
        $transaction = new Transaction($symbol, $quantity, $user_id, $price, $id);
        update_transaction($transaction);
        header("Location: transactions.php");
    } else if($action == "delete" && $user_id != "" && $symbol != "" && $quantity != 0){
        $transaction = new Transaction($symbol, $quantity, $user_id, $price, $id);
        delete_transaction($transaction);
        header("Location: transactions.php");
    } 
    
    $transactions = list_transactions();
    include('views/transactions.php');
    
} catch (Exception $e){
    $error_message = $e->getMessage();
    include('views/error.php');
}  
?>
