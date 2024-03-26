<?php
    $dir = $_SERVER["DOCUMENT_ROOT"]."/Lab6/uploads/";
    $target_file = $dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        echo "<p style='color: red'>Sorry, file already exists.</p>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<p style='color: red'>Sorry, your file has exceeded <b>5MB</b>.</p>";
        $uploadOk = 0;
    }

    if($fileType != "mp3" && $fileType != "jpg" && $fileType != "mp4") {
        echo "<p style='color: red'>Sorry, only <b>MP3, JPG, MP4</b> are allowed.</p>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<p style='color: red'><b>YOUR FILE WAS NOT UPLOADED.</b></p>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p style='color: green'>The file <b>". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "</b> has been uploaded <b>successfully</b>.</p>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>
