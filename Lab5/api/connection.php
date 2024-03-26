<?php
/**
 * Created by PhpStorm.
 * User: mvmanh
 * Date: 8/21/17
 * Time: 3:50 PM
 */

    header('Access-Control-Allow-Origin: *');
    
    $host = 'localhost';
    $dbName = 'students';
    $username = 'root';
    $password = '';

    try{
        $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => 'Unable to connect: ' . $ex->getMessage())));
    }

?>