<?php
    require_once ('connection.php');
    if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['price']) || !$_FILES["image"]["name"] || empty($_POST['description'])) {
        echo "<script>alert('Parameters not valid'); window.location.href='/Lab08/temp/add.php';</script>";
        die();
    }

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = 'images/'.$_FILES["image"]["name"];

    $sql = 'INSERT INTO product(id,name,price,image,description) VALUES(?,?,?,?,?)';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id,$name,$price,$image,$description));

        echo "<script>alert('Thêm sản phẩm thành công'); window.location.href='/Lab08/temp';</script>";

    }
    catch(PDOException $ex){
        echo "<script>alert('Thêm sản phẩm thất bại (trùng ID)'); window.location.href='/Lab08/temp/add.php';</script>";
        die();
    }

?>