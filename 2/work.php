<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Задание на Асинхронность</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <script>
    $.post( "ajax/getFruit.php", function( data ) {
        if(data.length<1 || data=="false"){
            alert("error");
            return;
        }
        $("#list").html(data);

    });

    function getColor(id){
        
        $.post( 
            "ajax/getColor.php",
            {id:id}, 
            function( data ) {
        if(data.length<1 || data=="false"){
            alert("error");
            return;
        }
        console.log("COlor = ",id);
        $("#list_color").html(data);

    });
    }
    </script>
    <div class="container">
    <h1>ФРУКТЫ!</h1>
        <div class="col-md-4">
            <div class="list-group" id="list">

            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group" id="list_color">

            </div>
        </div>
    </div>
  </body>
</html>