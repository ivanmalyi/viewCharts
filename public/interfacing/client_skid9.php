<?php
/*
<br/>
10.05.18 старт  <br/>
06.06.18 почти финиш тестирование  <br/>
скрипт приема от SKID 9 и <br/>
записи в БД  <br/>
skid9.php на 10.3.2.19/html/  БД kip  таблица skid9    <br/>
<br/>
*/


//
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/


header("Content-Type: text/html; charset=koi-8");
include "db_inc.php";

$k1 = $_POST['k1'];
$k2 = $_POST['k2'];
$k3 = $_POST['k3'];
$k4 = $_POST['k4'];
$k5 = $_POST['k5'];
$t_var = $_POST['t_var'];
$ves_var = $_POST['ves_var'];
$b1 = $_POST['b1'];
$b2 = $_POST['b2'];
$b3 = $_POST['b3'];
$speed = $_POST['speed'];
$strock_t = $_POST['strock_t'];
$date = $_POST['dd'];


 $query_t = "INSERT INTO `skid9` ( date, 
        k1, 
        k2, 
        k3,
        k4,
        k5,
        t_var,
        ves_var,
        b1,
        b2,
        b3,
        speed,
        string)
        VALUES ('$date',
        '$k1',
        '$k2' ,
        '$k3' ,
        '$k4' ,
        '$k5' ,
        '$t_var' ,
        '$ves_var' , 
        '$b1' ,
        '$b2' ,
        '$b3' ,
        '$speed' , 
        '$strock_t');"; 
  //   echo ($query_t);
//echo ("<br/>");   
$result_t = mysqli_query($link,$query_t) or die("Query failed : " . mysqli_error($link));	


//echo "$result_t"."<br>";
//echo "@link  ".$link.<br>
mysqli_close($link);