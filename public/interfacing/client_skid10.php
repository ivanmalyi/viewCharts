<?php

/*
<br/>
10.05.18 старт  <br/>
06.06.18 почти финиш тестирование  <br/>
скрипт приема от SKID 10 и <br/>
записи в БД  <br/>
skid10.php на 10.3.2.19/html/  БД kip  таблица skid10    <br/>
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

$t_var = $_POST['t_var'];
$zad = $_POST['zad'];
$speed = $_POST['speed'];
$t_sirop = $_POST['t_sirop'];
$zad_t_sirop = $_POST['zad_t_sirop'];
$p_sirop = $_POST['p_sirop'];
$vakuum = $_POST['vakuum'];
$strock_t = $_POST['strock_t'];
$date = $_POST['dd'];
//
//echo ($date);

$query_t = "INSERT INTO `skid10` ( date, 
        t_var, 
        zad, 
        speed,
        t_sirop,
        zad_t_sirop,
        p_sirop,
        vakuum,
        string)
        VALUES ('$date',
        '$t_var',
        '$zad' ,
        '$speed' ,
        '$t_sirop' ,
        '$zad_t_sirop' ,
        '$p_sirop' ,
        '$vakuum' , 
        '$strock_t');"; 
     echo ($query_t);
  //   echo ($query_t);
//echo ("<br/>");   
$result_t = mysqli_query($link,$query_t) or die("Query failed : " . mysqli_error($link));	


//echo "$result_t"."<br>";
//echo "@link  ".$link.<br>
mysqli_close($link);