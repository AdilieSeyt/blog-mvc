<?php

	require_once('./models/dbconnect.php');


function user_info($email, $password){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM user WHERE email = ? AND password=?');
        $query->execute([$email, md5($password)]);
        
        return $selectedLogin = $query->fetch();
    }
//la meme chose
function mail_existe($email){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM user WHERE email = ? ');
    $query->execute([$email]);
    return $mailExiste = $query->fetch();
}
function new_visitor($firstname, $lastname, $email, $password, $bio ){
    $db = dbConnect();
    $queryCategoryExiste = $db->prepare('INSERT INTO user (firstname, lastname, email, password,  bio ) VALUES (?, ?, ?, ?, ?)');
    $queryCategoryExiste->execute( array( 
    htmlspecialchars($firstname), 
    htmlspecialchars($lastname), 
    htmlspecialchars($email), 
    md5($password), 
    htmlspecialchars($bio)));
    return $db->$lastInsertId();
}