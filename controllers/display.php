<?php
    include_once 'crud.php';

    function getAllData($get, $from){
        return read("SELECT $get FROM $from");
    }
    
    function getData($get, $from,  $condition){
        return read("SELECT $get FROM $from WHERE $condition");
    }
    
    function productOnCart($userID){
        return read("SELECT * FROM cart c JOIN product p ON p.productID LIKE c.productID WHERE userID LIKE $userID");
    }

    function productOrders($userID){
        return read("SELECT * FROM orders o JOIN product p ON p.productID LIKE o.productID WHERE userID LIKE $userID");
    }

    function currentTime(){
        date_default_timezone_set('Asia/Jakarta');
        return date('Y-m-d');
    }

    function accDate(){
        date_default_timezone_set('Asia/Jakarta');
        return date('dmyhis');
    }
?>