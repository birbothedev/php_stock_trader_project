<?php

// some code referenced from Eric Charnesky php lectures

function login($email_address, $password){
    global $database;
  
    $query = 'SELECT email_address, password_hash FROM users ' .
            'where email_address = :email_address';
    
   $statement = $database->prepare($query);
   $statement->bindValue(":email_address", $email_address);
   $statement->execute();
   
   $user = $statement->fetch();
   $statement->closeCursor();
   
   if($user == NULL){
       return false;
   }
   
    $password_hash = $user['password_hash'];
    return password_verify($password, $password_hash);
   
}

function sign_up($email_address, $password){
    global $database;
    
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = 'UPDATE users SET password_hash = :password_hash '
            . 'WHERE email_addres = :email_address';
    
    $statement = $database->prepare($query);
    $statement->bindValue(':password_hash', $password_hash);
    $statement->bindValue(':email_address', $email_address);
    $statement->execute();
    $statement->closeCursor();
    
    return $password_hash;
}