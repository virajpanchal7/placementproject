<?php

function EmailExists ( $email ) {
    $db = GetDatabaseConnection ( 'placement_db' ) ;
    $query = $db->prepare ( 'SELECT COUNT(*) FROM `users` WHERE `email` = :email' ) ;
    $query->bindParam ( ':email' , $email , PDO::PARAM_STR ) ;
    $query->execute () ;
    $data = $query->fetch ( PDO::FETCH_ASSOC ) ;
    return intval ( array_shift ( $data ) ) > 0 ;
}

function GetLoggedAcctName () {
    return isLogged() ? $_SESSION ["username"] : null;
}

function GetLoggedAccountID ( ) {
    return isLogged() ? $_SESSION ["email"] : null;
}

function isLogged () {
    return isset ( $_SESSION [ "logged" ] ) ;
}

function FetchLoggedAccountInfo () {
    $db = GetDatabaseConnection ( 'placement_db' ) ;
    $query = $db->prepare ( 'SELECT * FROM `users` WHERE `username` = :username' ) ;
    $query->bindParam ( ':username' , $_SESSION [ "username" ] , PDO::PARAM_STR ) ;
    $query->execute () ;
    return ( $query->rowCount () >= 1 ) ? $query->fetch ( PDO::FETCH_ASSOC ) : false ;
}

function FetchAccountInfo ( $username ) {
    $db = GetDatabaseConnection ( 'placement_db' ) ;
    $query = $db->prepare ( 'SELECT * FROM `users` WHERE `username` = :username' ) ;
    $query->bindParam ( ':username' , $username , PDO::PARAM_STR ) ;
    $query->execute () ;
    return $query->fetch ( PDO::FETCH_ASSOC ) ;
}

function FetchAccountInfoByName ( $account ) {
    $db = GetDatabaseConnection ( 'placement_db' ) ;
    $query = $db->prepare ( 'SELECT * FROM `users` WHERE `username` = :account' ) ;
    $query->bindParam ( ':account' , $account , PDO::PARAM_STR ) ;
    $query->execute () ;
    return $query->fetch ( PDO::FETCH_ASSOC ) ;
}

function FetchAccountIdByName ( $name )
{

    $id = FetchAccountInfoByName($name)["username"];

    return $id;
}

function FetchAccountNameById ( $id ) {

    $name = FetchAccountInfo($id);
    return $name["username"];
}
