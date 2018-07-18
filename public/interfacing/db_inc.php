<?php
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo 'kuku2'; */
header("Content-Type: text/html; charset=utf8");
//DB_HOST - для хранения адреса сервера баз данных mySQL
define("DB_HOST", "localhost");
//DB_LOGIN - для хранения логина для соединения с сервером баз данных mySQL
	define("DB_LOGIN", "root");
	//DB_PASSWORD - для хранения пароля для соединения с сервером баз данных mySQL
	define("DB_PASSWORD", "tom");
	//DB_NAME - для хранения имени базы данных
	define("DB_NAME", "kip");
	
	//соединение с сервроМ БД
	$link =mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die ("нет соединения с бд");
	// выбор БД
	$list = mysqli_select_db ($link,DB_NAME) or die (mysqli_error());
mysqli_query($link,"SET CHARACTER SET 'utf8'");
mysqli_query($link,"SET character_set_client = 'utf8'");
mysqli_query($link,"SET character_set_connection = 'utf8'");
mysqli_query($link,"SET character_set_results = 'utf8'");
?>