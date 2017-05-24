<?php 

include_once "../mysql.php";
$db = new DB("localhost",'id1753604_test','id1753604_user','123123');
$db->connect();
$result = $db->executeQuery("select * from fruit");

while ($row = mysql_fetch_row($result)) 
{
    echo "<a href=\"#\" class=\"list-group-item\" onClick=\"getColor($row[0])\" id=\"$row[0] \">$row[1] [$row[2]]</a>";
}