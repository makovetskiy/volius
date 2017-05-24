<?php
    include_once "mysql.php";
    
    $db = new DB("localhost",'id1753604_test','id1753604_user','123123');
	$db->connect();
    $result = $db->executeQuery("select * from fruit");

    //Создайте таблицу фрукты с полями key, name. Заполните произвольными данными.
    //1.Выберите все записи из таблицы и выведите их на экран,
	while ($row = mysql_fetch_row($result)) 
    {
        echo "id: $row[0]  name: $row[1] key: $row[2]";
        echo "<br />\n";
    }

    //7.1 отсортируйте по полю key в запросе
    echo "<h4>7.1</h4>";
    $result = $db->executeQuery("SELECT id,name,`key` FROM `fruit` ORDER BY `key` DESC");
	while ($row = mysql_fetch_row($result)) 
    {
        
        echo "id: $row[0]  name: $row[1] key: $row[2]";
        echo "<br />\n";
    }

    //7.2 выберите те, в имени которых есть буква а
    echo "<h4>7.2</h4>";
    $result = $db->executeQuery("select * from fruit WHERE name LIKE '%а%'");
	while ($row = mysql_fetch_row($result)) 
    {
        echo "id: $row[0]  name: $row[1] key: $row[2]";
        echo "<br />\n";
    }

    //8. Создайте таблицу с цветами фруктов, связанную с первой, заполните несколько значений,
    //сделайте перекрестный запрос и выведите на экран названия фруктов и какие у них есть цвета
    echo "<h4>7.3</h4>";
    $result = $db->executeQuery("select * from fruit INNER JOIN colors ON fruit.id = colors.fruit_id");
	while ($row = mysql_fetch_row($result)) 
    {
        echo "id: $row[0]  name: $row[1] color: $row[4]";
        echo "<br />\n";
    }
    $db->close();
?>