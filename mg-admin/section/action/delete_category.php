<?
if($id=Lib_Category::getInstance()->delCategory($_POST['id']))
	$response=array("msg"=>"Удалена категория № {$_POST['id']}","status"=>"succes");
else
	$response=array("msg"=>"Не удалось удалить категорию!","status"=>"error");	
echo json_encode($response);