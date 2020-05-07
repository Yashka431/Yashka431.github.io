<?php
//Error_Reporting(E_ALL & ~E_NOTICE);//не выводить предупреждения
 


 define('HOST', 'localhost'); 		  //сервер
 define('USER', 'root'); 			  //пользователь
 define('PASSWORD', ''); 			  //пароль
 define('NAME_BD', 'LifeExampleShop');//база	
 define('PATH_CORE', "/mg-core");     //корневая папка ядра 
 

 require_once $_SERVER['DOCUMENT_ROOT'].PATH_CORE."/function.php";//подключаем функционал сайта
 require_once $_SERVER['DOCUMENT_ROOT'].PATH_CORE."/mg-start.php"; //подключаем файл настроек  
