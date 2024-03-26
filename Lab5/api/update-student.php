<?php
require_once ('connection.php');

$id = $_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];

$sql = 'UPDATE student set name = ?, email = ?, phone = ? where id = ?';

try{
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name,$email,$phone,$id));

    $count = $stmt->rowCount();

    if ($count == 1) {
        echo json_encode(array('status' => true, 'data' => 'Cập nhật sinh viên thành công'));
        header("Location: /Lab5/exercise3.html");
    }else {
        header("Location: /Lab5/exercise3.html");
        die(json_encode(array('status' => false, 'data' => 'Không có sinh viên nào được cập nhật')));
    }


}
catch(PDOException $ex){
    die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
}

?>