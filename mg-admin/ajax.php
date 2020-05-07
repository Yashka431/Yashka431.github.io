<?
$admin_section=true;

require_once $_SERVER['DOCUMENT_ROOT']."/config.php";

//подключаем страницу каталога
if($_REQUEST['url']=="catalog.php"){

	if(isset($_REQUEST['page'])){
	 $page=$_REQUEST['page']; 
	 $category_id=$_REQUEST['category_id'];
	}

	require_once "./section/".$_REQUEST['url'];
}
else{

if($_REQUEST['type']=='adminpage'){
require_once "./section/".$_REQUEST['url'];}
elseif($_REQUEST['type']=='plugin'){
require_once "../mg-plugins/".substr($_REQUEST['url'], 0, -4)."/".$_REQUEST['url'];
}
else
require_once "./section/".$_REQUEST['url'];
}
?>