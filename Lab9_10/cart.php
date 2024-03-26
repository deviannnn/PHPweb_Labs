<?php
    session_start();
    $_SESSION['total'] = count($_SESSION['purchase']);
    $strArray = array_count_values($_SESSION['purchase']);
    if (isset($_GET['deleteid']))
    {
        $_SESSION['purchase'] = array_diff($_SESSION['purchase'],array($_GET['deleteid']));
        print_r($_SESSION['purchase']);
        header("Location: cart.php");
    }
    if (isset($_GET['submit']))
    {
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $queries = array_diff($queries,array('reload'));
        print_r($queries);
        $_SESSION['purchase'] = array_diff($_SESSION['purchase'],$_SESSION['purchase']);
        foreach ($queries as $id => $quantity)
        {
            for ($i = 0; $i < (int)$quantity; $i++)
            {
                array_push($_SESSION['purchase'],$id);
            }
        }
        header("Location: cart.php");
    }
    if (isset($_GET['done']))
    {
        $_SESSION['carousel'] = '';
        $_SESSION['purchase'] = array();
        $_SESSION['total'] = 0;
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<style>

</style>
<div class="container">
    <h2>Giỏ hàng</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <td colspan="7">
                <a href="/Lab09-10/"><button type="button" class="btn btn-primary">Tiếp tục mua hàng</button></a>
            </td>
        </tr>
        <tr>
            <th>Ảnh</th>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <form>
        <?php
            require_once ('connection.php');
            $stt = 1;
            $sum = 0;
            foreach ($strArray as $id => $quantity)
            {
                $sql = "SELECT * FROM product WHERE id = ".$id;
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
                foreach ($data as $intodata)
                {
                    echo "<tr>";
                    echo "<td><img src='".$intodata['image']."' style='max-height: 50px'></td>";
                    echo "<td>".$stt."</td>";
                    echo "<td>".$intodata['name']."</td>";
                    echo "<td><input name=".$intodata['id']." type='number' value='".$quantity."'></td>";
                    echo "<td><p>".number_format($intodata['price'])." đ</p></td>";
                    echo "<td>".number_format($quantity*$intodata['price'])." đ</td>";
                    echo "<td><a href='/Lab09-10/cart.php?deleteid=".$intodata['id']."'><button type='button' class='btn btn-danger'>Xóa</button></a></td>";
                    echo "</tr>";
                    $sum += $quantity*$intodata['price'];
                }
                $stt += 1;
            }
        ?>
        <tr>
            <td colspan="7" style="text-align: right">
                <button name="submit" value="reload" type="submit" class="btn btn-success">Cập nhật giỏ hàng</button>
                <button type="button" class="btn btn-primary" onclick=removal()>Thanh toán</button>
            </td>
        </tr>
        </form>
        </tbody>
    </table>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thanh toán</h4>
            </div>
            <div class="modal-body">
                <?php
                    if ($sum == 0)
                    {
                        echo "<p>Chưa có sản phẩm để thanh toán</p>";
                        echo '</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <a href="/Lab09-10/cart.php?done=yes"><button type="submit" class="btn btn-primary">Trở về</button></a>
                        </div>';
                    }
                    else
                    {
                        echo "<p>Tổng hoá đơn của bạn là <strong>".number_format($sum)." đ</strong></p>";
                        echo '</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <a href="/Lab09-10/cart.php?done=yes"><button type="submit" class="btn btn-primary">Thanh toán</button></a>
                        </div>';
                    }
                ?>
        </div>
    </div>
</div>
</body>
<script>
    function removal() {
        $('#myModal').modal({show: true});
    }
</script>
</html>