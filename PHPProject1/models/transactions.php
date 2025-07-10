<?php

class Transaction {
    private $symbol, $quantity, $user_id, $price, $id;
    
    public function __construct($symbol, $quantity, $user_id = 0, $price=0, $id=0) {
        $this->set_symbol($symbol);
        $this->set_quantity($quantity);
        $this->set_user_id($user_id);
        $this->set_price($price);
        $this->set_id($id);
    }
    
    public function get_symbol() {
        return $this->symbol;
    }

    public function get_quantity() {
        return $this->quantity;
    }

    public function get_user_id() {
        return $this->user_id;
    }
    
    public function get_price() {
        return $this->price;
    }
    
    public function get_id() {
        return $this->id;
    }

    public function set_symbol($symbol): void {
        $this->symbol = $symbol;
    }

    public function set_quantity($quantity): void {
        $this->quantity = $quantity;
    }

    public function set_user_id($user_id): void {
        $this->user_id = $user_id;
    }
    
    public function set_price($price): void {
        $this->price = $price;
    }
    
    public function set_id($id): void {
        $this->id = $id;
    }
    
}


function list_transactions(){
    global $database;
    //RUN QUERY
    $query = 'SELECT transactions.user_id, stocks.symbol, transactions.quantity, transactions.price, transactions.id ' 
        . ' FROM transactions '
        . ' INNER JOIN stocks ON transactions.stock_id = stocks.id';
    $statement = $database->prepare($query);
    $statement->execute();
    $transactions = $statement->fetchAll();
    $statement->closeCursor();
    
    $transactions_array = array();
    
    foreach($transactions as $transaction){
        $transactions_array[] = new Transaction($transaction['symbol'], $transaction['quantity'],
        $transaction['user_id'], $transaction['price'], $transaction['id']);
    }
    
    return $transactions_array;
    
}

function insert_transaction($transaction){
    global $database;
    //GET STOCK ID AND CURRENT PRICE FROM STOCKS TABLE
    $query = "SELECT id, current_price FROM stocks WHERE symbol = :symbol";
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $transaction->get_symbol());
    $statement->execute();
    $stock_data = $statement->fetch();
    $statement->closeCursor();

    $stock_id = $stock_data['id'];
    $current_price = $stock_data['current_price'];

    //FIGURE OUT ACTUAL PURCHASE PRICE
    $purchase_price = $current_price * $quantity;

    //GET CASH BALANCE FROM USERS TABLE
    $query = 'SELECT cash_balance FROM users WHERE id = :user_id';
    $statement = $database->prepare($query);
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->execute();
    $cash_data = $statement->fetch();
    $statement->closeCursor();

    $cash_balance = $cash_data['cash_balance'];
    
    //CHECK TO MAKE SURE CASH BALANCE IS HIGHER THAN PURCHASE PRICE
    if($cash_balance > $purchase_price){
        $query = "INSERT INTO transactions (user_id, stock_id, quantity, price)"
            . "VALUES (:user_id, :stock_id, :quantity, :purchase_price)";
        $statement = $database->prepare($query);
        $statement->bindValue(":user_id", $transaction->get_user_id());
        $statement->bindValue(":stock_id", $stock_id);
        $statement->bindValue(":quantity", $transaction->get_quantity());
        $statement->bindValue(":purchase_price", $purchase_price);
        $statement->execute();
        $statement->closeCursor();

        //UPDATE THE USERS CASH BALANCE
        $query = "UPDATE users SET cash_balance = cash_balance - :purchase_price WHERE id = :user_id";
        $statement = $database->prepare($query);
        $statement->bindValue(":purchase_price", $purchase_price);
        $statement->bindValue(":user_id", $transaction->get_user_id());
        $statement->execute();
        $statement->closeCursor();

        echo "<p>Transaction successful</p>";
    }
}

function update_transaction($transaction){
    global $database;
    // Get stock ID from stocks table
    $query = "SELECT id FROM stocks WHERE symbol = :symbol";
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $transaction->get_symbol());
    $statement->execute();
    $stock_data = $statement->fetch();
    $statement->closeCursor();

    $stock_id = $stock_data['id'];

    // Update transaction
    $query = "UPDATE transactions SET quantity = :quantity WHERE user_id = :user_id AND stock_id = :stock_id";
    $statement = $database->prepare($query);
    $statement->bindValue(":quantity", $transaction->get_quantity());
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->bindValue(":stock_id", $stock_id);
    $statement->execute();
    $statement->closeCursor();

    echo "<p>Transaction updated successfully</p>";
}

function delete_transaction($transaction){
    global $database;
    //GET SYMBOL FROM STOCKS TABLE
    $query = "SELECT id, current_price FROM stocks WHERE symbol = :symbol";
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $transaction->get_symbol());
    $statement->execute();
    $stock_data = $statement->fetch();
    $statement->closeCursor();

    $stock_id = $stock_data['id'];
    $current_price = $stock_data['current_price'];

    //FIGURE OUT ACTUAL PURCHASE PRICE
    $purchase_price = $current_price * $quantity;

    //REMOVE TRANSACTION
    $query = "DELETE from transactions "
        . " where stock_id = :stock_id AND user_id = :user_id AND quantity = :quantity";
    $statement = $database->prepare($query);
    $statement->bindValue(":stock_id", $stock_id);
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->bindValue(":quantity", $transaction->get_quantity());
    $statement->execute();
    $statement->closeCursor();

    // UPDATE THE USER'S CASH BALANCE
    $query = "UPDATE users SET cash_balance = cash_balance + :purchase_price WHERE id = :user_id";
    $statement = $database->prepare($query);
    $statement->bindValue(":purchase_price", $purchase_price);
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->execute();
    $statement->closeCursor();
}