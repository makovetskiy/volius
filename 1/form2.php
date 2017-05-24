<html>
<head>
 <title></title>
</head>
<body>
<h2>Форма информации о файле:</h2><hr/>
<h4>5. Создайте форму с полем имя и дата, в дате при загрузке страницы должно стоять сегодняшнее число.
после отправки формы выведите полученные данные на экран</h4>
<form  enctype="multipart/form-data" method="POST">
    <input type="file" name="filename">
    <br>
    <button type="submit">Получить информацию</button>
</form>
<p>
<?php

if(isset($_FILES["filename"])){
     echo("Характеристики файла: <br>");
     echo("Имя файла: ");
     echo($_FILES["filename"]["name"]);
     echo("<br>Размер файла: ");
     echo($_FILES["filename"]["size"]);
     echo("<br>Каталог для загрузки: ");
     echo($_FILES["filename"]["tmp_name"]);
     echo("<br>Тип файла: ");
     echo($_FILES["filename"]["type"]);
}

?> 
</p>
</body>
</html>