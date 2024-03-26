<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ex1</title>
</head>
<body>

<style>
    .A{
        background-color: dodgerblue;
        color: black;
    }

    .A:hover td{
        background-color: deeppink;
        color: white;
    }
</style>


<table border="1" cellpadding="10" cellspacing="10" style="border-collapse: collapse; width:  300px; margin: auto">

    <!-- dùng php lặp n lần với các class khác nhau lặp đi lặp lại theo thứ tự -->
    <?php
        $colors = array("yellow", "dodgerblue", "green");
        for ($i = 1; $i <= 10; $i++) { 
            $currentColor = $colors[$i%3];
            echo    "<tr class='A' style='background-color: $currentColor'>
                        <td>$i</td>
                        <td>Sinh viên $i</td>
                    </tr>";
        }
        
    ?>

</table>

</body>
</html>