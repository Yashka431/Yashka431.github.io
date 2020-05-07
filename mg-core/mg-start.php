<?
session_start(); //открываем сессию
$_REQUEST=defender_xss($_REQUEST);
require_once "lib/db.php"; //подключаем файл настроек
DB::getInstance();
DB::query('SET names utf8'); 
$_SESSION['settings']=init_settings();
if(!$no_start){
$router=new Lib_Application; //создаем объект, который будет искать нуджные контролеры
$member=$router->Run();//Начинаем поиск нужного контролера
	if(!$admin_section){
	print_gui();
	}
}