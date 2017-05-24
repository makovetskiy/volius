<html>
<head>
 <title></title>
</head>
<body>
<h2>Форма с датой:</h2><hr/>
<h4>5. Создайте форму с полем имя и дата, в дате при загрузке страницы должно стоять сегодняшнее число.
после отправки формы выведите полученные данные на экран</h4>
<form>
    <p>
    <?php
        if(empty($_GET['name'])){
            echo "<strong>*обязательное поле</strong>";
        }
    ?>
    <br><input type="text" name="name" placeholder="Имя" />
    </p>
    <p>
    <?php
        if(empty($_GET['name'])){
            echo "<strong>*обязательное поле</strong>";
        }
    ?>
    <br><input type="text" name="data" placeholder="<?php echo date("d.m.Y"); ?>"/>
    </p>
    <button type="submit">Отправить</button>
</form>
<p>
<?php
    if(!empty($_GET['name']) && !empty($_GET['data'])) 
    {
        ?>
        <p><strong>Имя:</strong> <?=$_GET['name'];?></p>
        <p><strong>Дата:</strong> <?=$_GET['data'];?></p>
        <?php
    }
?>
</p>
</body>
</html>