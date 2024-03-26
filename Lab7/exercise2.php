<?php
    
    session_start();
    //session_destroy();
    if (!isset($_SESSION["stack"])) {
        $_SESSION["stack"] = array($_SERVER["DOCUMENT_ROOT"]."/Lab07/documents/");
    }

    $dir = "";
    $err = "";
    $mes = "";

    if (isset($_POST["submit"]) && $_POST["submit"] == "Go Into" && !str_contains($_POST["fName"], '.'))
    {
        array_push($_SESSION["stack"],$_POST["fName"]);
    }

    if (isset($_POST["submit"]) && $_POST["submit"] == "Back" && count($_SESSION["stack"]) > 1)
    {
        array_pop($_SESSION["stack"]);
    }

    foreach ($_SESSION["stack"] as $i) {
        $dir .= $i;
    }

    if (isset($_POST["submit"]) && $_POST["submit"] == "New folder" && !empty($_POST["folderName"])) {
        if (!file_exists($dir.$_POST["folderName"])) {
            mkdir($dir.$_POST["folderName"], 0777, true);
        }
    }

    if (isset($_POST["submit"]) && $_POST["submit"] == "Upload") {
        $target_file = $dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            $err = "<p style='color: red'>Sorry, file already exists.</p>";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $err = "<p style='color: red'>Sorry, your file has exceeded <b>5MB</b>.</p>";
            $uploadOk = 0;
        }

        if($fileType != "mp3" && $fileType != "txt" && $fileType != "mp4" && $fileType != "rar" && $fileType != "zip") {
            $err = "<p style='color: red'>Sorry, only <b>MP3, MP4, TXT, RAR, ZIP</b> are allowed.</p>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $mes = "<p style='color: red'><b>YOUR FILE WAS NOT UPLOADED.</b></p>";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $mes = "<p style='color: green'>The file <b>". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "</b> has been uploaded <b>successfully</b>.</p>";
            } else {
                $mes = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (isset($_POST["submit"]) && $_POST["submit"] == "Rename" && !empty($_POST["newName"])) {
        $old = $_POST["oldName"];
        $new = $_POST["newName"];
        $new .= strrchr($old,".");
        rename($dir.$old, $dir.$new);
    }

    if (isset($_POST["submit"]) && $_POST["submit"] == "Delete") {
        if (is_dir($dir.$_POST["delName"]))
        {
            $dirToDlt = $dir.$_POST["delName"];
            $it = new RecursiveDirectoryIterator($dirToDlt, RecursiveDirectoryIterator::SKIP_DOTS);
            $filesToDlt = new RecursiveIteratorIterator($it,
                        RecursiveIteratorIterator::CHILD_FIRST);
            foreach($filesToDlt as $fileToDlt) {
                if ($fileToDlt->isDir()){
                    rmdir($fileToDlt->getRealPath());
                } else {
                    unlink($fileToDlt->getRealPath());
                }
            }
            rmdir($dirToDlt);
        }
        else
        {
            unlink($dir.$_POST["delName"]);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ex2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<style>
    tr.header{
        font-weight: bold;
        color: white;
        background-color: deepskyblue;
    }

    td{
        padding: 10px;
    }

</style>

<script>
    $(document).ready(function () {
        $(".rename").click(function () {
            $("#oldName").val($(this).closest("tr").find(".link").text());
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $("#save").click(function () {
            $("#renameSubmit").click();
        });

        $(".delete").click(function () {
            $('#delDialog').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#delName").val($(this).closest("tr").find(".link").text());
        });

        $("#del").click(function () {
            $("#delSubmit").click();
        });
        
        $(".link").click(function () {
            $("#fName").val($(this).text()+'/');
            $("#intoSubmit").click();
        });

        $("#back").click(function () {
            $("#backSubmit").click();
        });
    });
</script>


<br>
<div style="width: 300px; margin: auto; margin-bottom: 50px">

    <form method="post">
        <input type="text" name="folderName">
        <input type="submit" value="New folder" name="submit">
    </form>

    <br>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit">
    </form>

    <br>

    <span><?php echo $err; echo $mes; ?></span>

    <form method="post" hidden>
        <input id="fName" type="text" name="fName">
        <input id="intoSubmit" type="submit" value="Go Into" name="submit">
    </form>
    <form method="post" hidden>
        <input id="backSubmit" type="submit" value="Back" name="submit">
    </form>
</div>



<table border="1" cellpadding="15" cellspacing="10" style="text-align: center; margin: auto; border-collapse: collapse">
    <tr>
        <td colspan="6">
            <button id="back">Back</button>
        </td>
    </tr>
    <tr class="header">
        <td>Icon</td>
        <td>File name</td>
        <td>Type</td>
        <td>Last modified</td>
        <td>File size</td>
        <td>Action</td>
    </tr>
    <?php
        function getType_Icon($ext) {
            switch ($ext) {
                case "txt":
                    return "Text?text-x-tex-icon.png";
                  break;
                case "mp3":
                    return "Music?audio-x-generic-icon.png";
                  break;
                case "mp4":
                    return "Video?mp4-icon.png";
                  break;
                case "rar":
                    return "Compress?document-compress-icon.png";
                  break;
                case "zip":
                    return "Compress?document-compress-icon.png";
                  break;
                default:
                    return "Folder?Folder-icon.png";
                  break;
            }
        }

        function humanFilesize($size, $precision = 1) {
            $units = array(' B',' KB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
            $step = 1024;
            $i = 0;
            while (($size / $step) > 0.9) {
                $size = $size / $step;
                $i++;
            }
            return round($size, $precision).$units[$i];
        }

        $files = scandir($dir);
        foreach ($files as $key => $fileName) {
            if ($fileName != "." && $fileName != "..")
            {   
                $ext = pathinfo($dir.$fileName, PATHINFO_EXTENSION);
                $fileSize = empty($ext) ? "-" : humanFilesize(filesize($dir.$fileName));
                $fileTime = date("d/m/Y", filemtime($dir.$fileName));
                $fileType_Icon = getType_Icon($ext);
                $Type_Icon = explode("?",$fileType_Icon);
                echo "<tr>
                        <td><img src='images/$Type_Icon[1]'></td>
                        <td><a class='link'>$fileName</a></td>
                        <td>$Type_Icon[0]</td>
                        <td>$fileTime</td>
                        <td>$fileSize</td>
                        <td><a class='rename'>Rename</a> | <a class='delete'>Delete</a></td>
                    </tr>";
            }
        }
    ?>
</table>


<!-- Rename dialog -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đổi tên thư mục</h4>
            </div>
            <div class="modal-body">
                <p>Nhập tên mới.</p>
                <form method="post">
                    <input id="newName" type="text" name="newName">
                    <input id="oldName" type="text" name="oldName" hidden>
                    <input id="renameSubmit" type="submit" value="Rename" name="submit" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button id="save" type="button" class="btn btn-success" data-dismiss="modal">Lưu</button>
            </div>
        </div>
    </div>
</div>
<!-- Rename dialog -->

<!-- Delelte dialog -->
<div class="modal fade" id="delDialog" tabindex="-1" role="dialog" aria-labelledby="delDialogTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="delDialogTitle">Xoá thư mục</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Bạn chắc chắn vẫn muốn xoá ?
            <form method="post" hidden>
                <input id="delName" type="text" name="delName">
                <input id="delSubmit" type="submit" value="Delete" name="submit">
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button id="del" type="button" class="btn btn-primary">Vẫn xoá</button>
        </div>
        </div>
    </div>
</div>
<!-- Delelte dialog -->


</body>
</html>