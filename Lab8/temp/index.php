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
    body{
        padding-top: 50px;
    }
    table{

        text-align: center;
    }
    td{
        padding: 10px;
    }
    tr.item{
        border-top: 1px solid #5e5e5e;
        border-bottom: 1px solid #5e5e5e;
    }

    tr.item:hover{
        background-color: #d9edf7;
    }

    tr.item td{
        min-width: 150px;
    }

    tr.header{
        font-weight: bold;
    }

    a{
        text-decoration: none;
    }
    a:hover{
        color: deeppink;
        font-weight: bold;
    }
</style>


<script>
    $(document).ready(function () {

        $.get("/Lab08/get-product.php", function(data, status){
            data.data.forEach(element => {
                let row = $('<tr class="item">');
                row.append('<td><img src="../' + element.image + '" style="max-height: 80px"></td>');
                row.append('<td class="produce-name">' + element.name+'</td>');
                row.append('<td>' + element.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' VND</td>');
                row.append('<td>' + element.description+'</td>');
                row.append("<td><a href='#'>Edit</a> | <a onclick='confirmRemoval(this)'>Delete</a></td>");
               $('#table-body').append(row);
            });
        },"json");
        
    });

    function confirmRemoval(a) {
        $('#produce-name').html($(a).closest("tr").find(".produce-name").text());
        $("#delName").val($(a).closest("tr").find(".produce-name").text());
        $('#myModal').modal({show: true});
    }

    function removal(a) {
        $('#delSubmit').submit();
    }

</script>



<table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto" id="myTable">
    <thead>
        <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
            <td colspan="5">
                <a href="add.php">Thêm sản phẩm</a>
            </td>
        </tr>
        <tr class="header">
            <td>Image</td>
            <td>Name</td>
            <td>Price</td>
            <td>Description</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody id="table-body"></tbody>
    <tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
        <td colspan="5">
            <p>Số lượng sản phẩm: 5</p>
        </td>
    </tr>
</table>


<!-- Delete Confirm Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Xoá sản phẩm</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa sản phẩm <strong id="produce-name"></strong>?</p>
                <form id="delSubmit" action="../delete-product.php" method="post" hidden>
                    <input id="delName" type="text" name="name">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick=removal()>Delete</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>