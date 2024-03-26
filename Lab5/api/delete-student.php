<?php
require_once ('connection.php');

if (empty($_GET['id']) ) {
    die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
}

$id = $_GET['id'];

$sql = 'DELETE FROM student where id = ?';

echo "id: " . $id;

try{
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id));

    $count = $stmt->rowCount();

    if ($count == 1) {
        echo json_encode(array('status' => true, 'data' => 'Xóa sinh viên thành công'));
        header("Location: /Lab5/exercise3.html");
    }else {
        die(json_encode(array('status' => false, 'data' => 'Mã sinh viên không hợp lệ')));
    }


}
catch(PDOException $ex){
    die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
}



?>