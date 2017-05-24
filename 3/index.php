<?php
include_once "mysql.php";



$db = new DB("localhost",'id1753604_test','id1753604_user','123123');


$db->connect();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Задание 3</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <script>
    var index    = 0;
    var rowCount = 0;
    var salads   = [];

    function delRow(id,index) {
        console.log(index);
        id.remove();
        var tarray = [];
        for(var i=0;i<rowCount;i++ ){
            if(salads[i].id!=index){
                tarray.push(salads[i]);
            }
        }
        salads = tarray;
        rowCount--;
    }
    function addRow() {
        index++;
        rowCount++;
        var count = $("#count").val();
        var salad = $('input[name="salad"]:checked').val();
        $('#s-table').append('<tr id="tr'+index+'"><td>'+salad+'</td><td>'+count+'</td><td><button class="btn btn-danger"  onClick="delRow(tr'+index+','+index+')">Удалить</button></td></tr>');
       var s = {
           id    : index,
           name  : salad,
           count : count
       };
       salads.push(s);
    }
    function submit(){
        $('#table_id').DataTable().destroy();
        var sklad = [];
        if($("#warehouse1").prop('checked') == true){
            sklad.push($("#warehouse1").val());
        }
        if($("#warehouse2").prop('checked') == true){
            sklad.push($("#warehouse2").val());
        }
        $.ajax({
        url: 'calculate.php',
        data: {
            data: salads,
            sklad: sklad
        },
        type: 'POST',
        dataType: 'JSON', 
        }).done(function( data ) {
            if(data.length<1 || data=="false"){
                alert("error");
                return;
            }
            console.log(data)
            $('#table_id').DataTable( {
                data: data,
                paging: false,
                searching: false,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'countNeed' },
                    { data: 'countWarehouses' },
                    { data: 'countRemain' }
                ]

        });
    });}
    
    </script>
    <div class="container">
    <h2>Конструктор салатов</h2>
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Салаты</h3>
                </div>
                    <div class="panel-body">
                        <?php 
                        $result = $db->executeQuery("select * from Salads");

                        while ($row = mysql_fetch_row($result)) 
                        {
                            
                            echo "<label><input type='radio' name='salad' id='salad' value='$row[1]'> $row[1]</label><br>";
                            
                        }

                        ?>
                </div>
                <div class="panel-footer">
                    <input type="text" id="count" class="form-control"/>
                    <button class="btn btn-success form-control" onClick="addRow()">
                        <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>  Добавить
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Склады</h3>
                </div>
                    <div class="panel-body">
                        <?php 
                            $result = $db->executeQuery("select * from Warehouses");
                            while ($row = mysql_fetch_row($result)) 
                            {
                                echo "<label><input type='checkbox' id='warehouse$row[0]' value='$row[0]'> $row[1]</label><br>";
                            }
                        ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Список салатов</h3>
                </div>
                    <div class="panel-body">
                    <table class="table" id="s-table">
                        <tr>
                        <th>#</th><th>Название</th><th>Количество</th>
                        </tr> 
                    </table>
                    <button class=" btn btn-success" onClick="submit()">Расчитать</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Фрукт</th>
                    <th>Нужно</th>
                    <th>На складах</th>
                    <th>Остаток</th>
                </tr>
            </thead>
            </table>
        </div>
    </div>
  </body>
</html>