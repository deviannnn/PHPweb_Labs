<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex1</title>
</head>
<body>
    <table style='border-collapse: collapse;'>
        <tr>
            <?php
                for ($i = 1; $i < 11; $i++) {
                    echo "<td style='border: 1px solid; padding: 5px'>";
                    for ($j = 1; $j < 11; $j++) {
                        echo "$i * $j = ".($i*$j);
                        echo "<br>";
                    }
                    echo "</td>";
                    
                }
            ?>
        </tr>
    </table>
</body>
</html>