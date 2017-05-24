<?php 
$id ="";
if(isset($_POST['id'])){$id = $_POST['id'];}
else{
    echo('не выбран фрукт!');
    return;
}
include_once "../mysql.php";
$db = new DB("localhost",'id1753604_test','id1753604_user','123123');
$db->connect();
$result = $db->executeQuery("select * from colors where fruit_id=$id");

while ($row = mysql_fetch_row($result)) 
{
    echo "<a href=\"#\" class=\"list-group-item\" >$row[1] </a>";
}