<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex3</title>
</head>
<body>
    <?php
        $name = empty($_GET["name"]) ? "Undefine" : $_GET["name"];
        $sex = isset($_GET['sex']) ? $_GET["sex"] : "Undefine";
        $box1 = isset($_GET['box1']) ? $_GET['box1'] : "";
        $box2 = isset($_GET['box2']) ? $_GET['box2'] : "";
        $box3 = isset($_GET['box3']) ? $_GET['box3'] : "";
        $using = array($box1, $box2, $box3);
    ?>
    Your name is: <b><?php echo $name; ?></b><br>
    Your sex is: <b><?php echo $sex; ?></b><br>
    You <?php
            $temp = "";
            foreach ($using as $key => $box) {
                if (!empty($box))
                {
                    $temp .= "<b>".$box."</b>"." and ";
                }
            }
            $result = empty($temp) ? "<b>Using nothing</b>" : trim($temp," and ");
            echo $result;
        ?><br>
    You have <b><?php echo $_GET["child"]; ?></b> child
</body>
</html>