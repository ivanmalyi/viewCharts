<?php
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/

$dataString=$_POST['dataString'];
$date=$_POST['date'];

$PDO = connection(); // подключение к БД
writeData($PDO, $dataString, $date); //запись в БД

/***********************************************************************************************************************/
//создается подключение к базе данных
function connection(): \PDO
{
    $dsn = 'mysql:dbname=kip;host=localhost';
    $user = 'root';
    $password = 'tom';

    try {
        $PDO = new PDO($dsn, $user, $password);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $PDO->exec("SET NAMES utf8");
        $PDO->exec("SET character set utf8");
        $PDO->exec("SET character_set_connection='utf8'");

        return $PDO;
    } catch (\PDOException $e) {
        echo $e->getMessage() . "\n";
        echo $e->getLine();

        return $PDO = null;
    }
}

//записываются данные в таблицу
function writeData(PDO $PDO, string $dataString, string $date)
{
    $dataArray = explode('$', $dataString);

    $sql = 'INSERT INTO skid10 ( date, t_var, zad, speed, t_sirop, zad_t_sirop, p_sirop, vakuum, string)
            VALUES (:date, :t_var, :zad, :speed, :t_sirop, :zad_t_sirop, :p_sirop, :vakuum, :string)';

    try {
        $payments = $PDO->prepare($sql);

        $payments->bindParam(':date', $date, PDO::PARAM_STR);
        $payments->bindParam(':t_var',  $dataArray[0], PDO::PARAM_INT);
        $payments->bindParam(':zad',  $dataArray[1], PDO::PARAM_INT);
        $payments->bindParam(':speed',  $dataArray[2], PDO::PARAM_INT);
        $payments->bindParam(':t_sirop',  $dataArray[3], PDO::PARAM_INT);
        $payments->bindParam(':zad_t_sirop',  $dataArray[4], PDO::PARAM_INT);
        $payments->bindParam(':p_sirop',  $dataArray[5], PDO::PARAM_INT);
        $payments->bindParam(':vakuum',  $dataArray[6], PDO::PARAM_INT);
        $payments->bindParam(':string',  $dataString, PDO::PARAM_STR);

        $payments->execute();
    } catch (\PDOException $e) {
        echo $e->getMessage() . "\n";
        echo $e->getLine();
        $firstPay = null;
    }
}
