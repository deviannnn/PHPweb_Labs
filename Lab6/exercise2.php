<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex2</title>
</head>
<body>
    <?php
        $error = "";
        $num1 = "";
        $num2 = "";
        $operation = "";
        $result = "";
        if(isset($_GET['submit'])) {
            $num1 = $_GET['num1'];
            $num2 = $_GET['num2'];
            if (empty($num1)) {
                $error = "Chưa nhập số hạng 1!";
            }
            elseif (empty($num2)) {
                $error = "Chưa nhập số hạng 2!";
            }
            elseif(!isset($_GET['operation'])) {
                $error = "Chưa chọn phép tính!";
            }
            else {
                $operation = $_GET['operation'];
                switch ($operation) {
                    case "add":
                        $result = "$num1 + $num2 = ".($num1 + $num2);
                        break;
                    case "sub":
                        $result = "$num1 - $num2 = ".($num1 - $num2);
                      break;
                    case "mul":
                        $result = "$num1 * $num2 = ".($num1 * $num2);
                      break;
                    default:
                    $result = "$num1 / $num2 = ".($num1 / $num2);
                }
            }
        }
    ?>

    <form action="">
        <label for="num1">Số hạng 1</label>
        <input type="text" id="num1" name="num1" value="<?php echo $num1 ?>"><br><br>
        <label for="num2">Số hạng 2</label>
        <input type="text" id="num2" name="num2" value="<?php echo $num2 ?>"><br><br>

        <input type="radio" name="operation" id="add" value="add" <?php if ($_GET['operation'] == 'add') echo 'checked'; ?>>
        <label for="add">Cộng</label>
        <input type="radio" name="operation" id="sub" value="sub" <?php if ($_GET['operation'] == 'sub') echo 'checked'; ?>>
        <label for="sub">Trừ</label>
        <input type="radio" name="operation" id="mul" value="mul" <?php if ($_GET['operation'] == 'mul') echo 'checked'; ?>>
        <label for="mul">Nhân</label>
        <input type="radio" name="operation" id="div" value="div" <?php if ($_GET['operation'] == 'div') echo 'checked'; ?>>
        <label for="div">Chia</label><br><br>
        <span id="result"></span>
        <input type="submit" name="submit" value="Xem kết quả"><br><br>
        <span id="error" style='color: red'></span>
    </form>

    <script>
        let a = "<?php echo $result ?>";
        let b = "<?php echo $error ?>";
        if (b == "")
        {
            document.getElementById("error").innerHTML = "";
        }
        else
        {
            document.getElementById("error").innerHTML = b;
        }
        if (a == "")
        {
            document.getElementById("result").innerHTML = "";
        }
        else
        {
            document.getElementById("result").innerHTML = a + "<br><br>";
        }
    </script>
</body>
</html>