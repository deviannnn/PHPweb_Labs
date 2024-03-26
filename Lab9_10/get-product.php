<?php
    
    require_once ('connection.php');

    $sql = 'SELECT * FROM product WHERE type = 2';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }

    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

    {
        $data[] = $row;
    }
    
    $name = "";
    $price = "";
    $description ="";
    $vote = "";
    $image ="";
    foreach ($data as $intodata) {
        foreach ($intodata as $key => $value) {
            switch ($key) {
                case "name":
                  $name = $value;
                  break;
                case "price":
                  $price = $value;
                  break;
                case "description":
                  $description = $value;
                  break;
                case "vote":
                  $vote = $value;
                  break;
                case "image":
                  $image = $value;
                  break;
            }
        }
        echo $name." ".$price." ".$description." ".$vote." ".$image."<br>";
    }
    
    echo '<br><br><br>';
    echo json_encode(array('status' => true, 'data' => $data));

?>