<?php
require_once ('connection.php');

if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['image']) || !isset($_POST['description'])) {
    die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = 'UPDATE student set name = ?, email = ?, phone = ? where id = ?';

try{
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name,$email,$phone,$id));

    $count = $stmt->rowCount();

    if ($count == 1) {
        echo json_encode(array('status' => true, 'data' => 'Cập nhật sinh viên thành công'));
    }else {
        die(json_encode(array('status' => false, 'data' => 'Không có sinh viên nào được cập nhật')));
    }


}
catch(PDOException $ex){
    die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
}

?>