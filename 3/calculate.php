<?php
include_once "mysql.php";


$db = new DB("localhost",'id1753604_test','id1753604_user','123123');

$db->connect();


$data = '';

$sklad = '';

if(isset($_POST['data'])){
	
	$data = $_POST['data'];
	
}

if(isset($_POST['sklad'])){
	
	$sklad = $_POST['sklad'];
	
}

$array = array();

$result = $db->executeQuery("select * from Fruits");

while ($row = mysql_fetch_row($result)) 
{
	
	$arr = array(
	"id"                => "$row[0]", 
	"name"              => "$row[1]", 
	"countWarehouses"   => 0,
	"countNeed"         => 0,
	"countRemain"       => 0
	);
	
	array_push($array,$arr);
	
}

$fruitNeed = array();

foreach($data as $item){
	
	for ($i=0;$i<$item['count'];$i++)
	{
		
		$ingradients = $db->executeQuery("select * from Salads_ingradients
                                INNER JOIN Salads ON Salads.id=Salads_ingradients.s_id
                                WHERE Salads.name = '".$item['name']."'");
		
		
		while ($row = mysql_fetch_assoc($ingradients)) 
		{
			
			for ($j=0;$j<count($array);$j++)
			{
				
				if($array[$j]['id']==$row['fr_id']){
					
					$array[$j]['countNeed'] = $array[$j]['countNeed'] + $row['quantity'];
					
				}
				
			}
			
		}
		
	}
	
	
}


foreach($array as $item)
{
	
	for ($k=0;$k<count($sklad);$k++){

		$countWarehouses =  $db->executeQuery("select * from Balance  WHERE Balance.fr_id = '".$item['id']."' AND wh_id ='".$sklad[$k]."'");
		
		while ($row = mysql_fetch_assoc($countWarehouses)) 
		{
			
			for ($j=0;$j<count($array);$j++)
			{
				
				if($array[$j]['id']==$row['fr_id']){
					
					$array[$j]['countWarehouses'] = $array[$j]['countWarehouses'] + $row['quantity'];
					
				}
				
			}
			
		}
		
	}
	
	
}

$res = array();
for ($j=0;$j<count($array);$j++)
{
	
	$count =  $array[$j]['countWarehouses'] - $array[$j]['countNeed'];
	$need = 0;
	if($count<1)
	{
		
		$array[$j]['countRemain'] = 0;
		$need = $array[$j]['countNeed'] - $array[$j]['countWarehouses'];
        $fr_rep  = $db->executeQuery("SELECT * from Fruit_replace INNER JOIN Fruits on Fruits.id = to_id INNER JOIN Balance on Balance.fr_id = to_id where  from_id ='".$array[$j]['id']."'");
        while ($row = mysql_fetch_assoc($fr_rep)) 
		{
            $arr = array(
                "id"                => $row['to_id'], 
                "name"              => $array[$j]['name']."=>".$row['name'], 
                "countWarehouses"   => $row['quantity'],
                "countNeed"         => $need,
                "countRemain"       => $row['quantity'] - $need
            );
            array_push($array,$arr);
                
        }
	}
	
	else
	{
		
		$array[$j]['countRemain'] = $count;
		$need = $count;
	}
        
    
    if($array[$j]['countNeed']>0){
        array_push($res,$array[$j]);
    }
	
}
echo json_encode($res);
