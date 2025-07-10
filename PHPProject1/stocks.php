

<?php

try {
    require_once 'utility/ensurelogin.php';
    require_once 'models/database.php';
    require_once 'models/stocks.php';
    
    $database = new PDO($data_source_name, $username, $password);

    $action = htmlspecialchars(filter_input(INPUT_POST, "action"));
    
    // INSERT VALUES
    $symbol = htmlspecialchars(filter_input(INPUT_POST, "symbol"));
    $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
    $current_price = filter_input(INPUT_POST, "current_price", FILTER_VALIDATE_FLOAT);
    
    if ($action == "insert" && $symbol != "" && $name != "" && $current_price != 0){
        $stock = new Stock($symbol, $name, $current_price);
        insert_stock($stock);
        header("Location: stocks.php");
    } else if ($action == "update" && $symbol != "" && $name != "" && $current_price != 0){
        $stock = new Stock($symbol, $name, $current_price);
        update_stock($stock);
        header("Location: stocks.php");
    } else if ($action == "delete" && $symbol != ""){
        $stock = new Stock($symbol, "", 0);
        delete_stock($stock);
        header("Location: stocks.php");
    } else if ($action != ""){
        $error_message =  "Missing information, please double check all fields before submitting form";
        include('views/error.php');
    }
    
    $stocks = list_stocks();
    include('views/stocks.php');
    
    
} catch (Exception $e){
    $error_message = $e->getMessage();
    include('views/error.php');
}  
?>
