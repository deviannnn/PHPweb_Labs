<?php
require_once ('connection.php');

if (empty($_POST['name']) ) {
    echo "<script>alert('Parameters not valid'); window.location.href='/Lab08/temp';</script>";
    die();
}

$name = $_POST['name'];

$sql = 'DELETE FROM product where name = ?';

echo "name: " . $name;

try{
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name));

    $count = $stmt->rowCount();

    if ($count == 1) {
        echo "<script>alert('Xóa sản phẩm thành công'); window.location.href='/Lab08/temp';</script>";
    }else {
        echo "<script>alert('Xóa sản phẩm thất bại'); window.location.href='/Lab08/temp';</script>";
        die();
    }

}
catch(PDOException $ex){
    echo "<script>alert('Xóa sản phẩm thất bại'); window.location.href='/Lab08/temp';</script>";
    die();
}

?>