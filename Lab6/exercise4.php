<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Ex4</title>
</head>
<style>
    .box-container {
        width: 302px;
        height: 300px;
        border: 1px solid;
        display: flex;
        flex-wrap: wrap;
        align-self: center;
    }
</style>
<body>
    <div class="container" style="text-align: -webkit-center;">
        <div class="box-container">
            <?php
                function rand_color() {
                    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }
                for ($i = 0; $i < 100; $i++)
                {
                    $color = rand_color();
                    echo "<div class='box' style='width: 30px; height: 30px; border: 1px solid; background-color: $color'></div>";
                }
            ?>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var bg =  $("body").css("background-color");

        $(".box").click(function() {
            $("body").css("background-color",$(this).css("background-color"));
            bg =  $("body").css("background-color");
        });

        $(".box").hover(
            function() {
                $("body").css("background-color",$(this).css("background-color"));
            }
            ,
            function() {
                $("body").css("background-color", bg);
            }
        );
    })
</script>

</html>