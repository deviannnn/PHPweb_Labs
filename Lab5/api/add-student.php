<?php
    require_once ('connection.php');

    $name = $_GET['name'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];

    $stmt = $dbCon->prepare("SELECT COUNT(*) AS c FROM `student`");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['c'] + 1;
    echo $id;
    

    $sql = 'INSERT INTO student(id,name,email,phone) VALUES(?,?,?,?)';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id,$name,$email,$phone));
        header("Location: /Lab5/exercise3.html");
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>