<?php
/**
* метод вывода массива на экран
* @array - массив для печати
*/
function printListArray($array)
{
    if(empty($array)){
        echo("Error, empty array!");
        exit;
    }
    echo("<p>");
    foreach($array as $item){
        echo("[".$item."]");
    }
    echo("</p>");
}

/**
* метод создания массива случайных чисел
* @size - размер массива
* @min  - минимальное значение числа
* @max  - максимальное значение числа
* Возвращает массив
*/
function createRandomArray($size,$min,$max)
{
    if($size<1){
        echo ("Error, size not empty or <1");
        exit;
    }
    
    if(empty($min) || empty($max))
    {
        echo ("Error, max and min not empty");
        exit;
    }
    $array = array();   
    for ($i=0; $i<$size; $i++)
    {
        $array[$i] = rand($min, $max);
    }

    return $array;
}

/**
* метод конвертации числовых кодов в символы
* @array - массив который нужно конвертировать
* Возвращает массив
*/
function codeToSymbol($array)
{
    if(empty($array)){
        echo("Error, empty array!");
        exit;
    }
    $arr = array();
    for($i=0;$i<count($array);$i++){
        $arr[$i] = array($array[$i] => chr($array[$i]));
    }
    return $arr;
}

/**
* метод сортировки массива по возростанию
* @array - массив который нужно отсортировать
* Возвращает массив
*/
function sortArrayASC($array)
{
    if(empty($array)){
        echo("Error, empty array!");
        exit;
    }
    sort($array,SORT_NUMERIC);
    return $array;
}

/**
* метод записи в файл json массива,
* @array - массив для конвертации в  json
*/
function fileWrite($array)
{
    if(empty($array)){
        echo("Error, empty array!");
        exit;
    }
    try{
        $fileName = "write.txt";
        $file     = fopen($fileName, 'w') or die("Error, not open file!");
        fwrite($file,json_encode($array));
        fclose($file); 
        echo("Файл записан!");
    }
    catch(Exception $error)
    {
        echo $error;
    }
    
}

// Ход работы :

//1. Создайте массив из 10 случайных чисел от 65 до 90
$arr = createRandomArray(10,65,90); 
printListArray($arr); 
//

//2. Отсортируйте массив по возрастанию и выведите на экран
$arr = sortArrayASC($arr);
printListArray($arr);
//

//3. Преобразуйте числовые коды в буквы и выведите на экран
$arr = codeToSymbol($arr);
echo json_encode($arr);
//

//4. Записать полученный массив в файл mas.txt в формате json
fileWrite($arr);
//