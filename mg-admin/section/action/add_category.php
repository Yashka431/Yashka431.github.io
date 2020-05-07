<?
if($id=Lib_Category::getInstance()->addCategory($_POST))
	$response=array("msg"=>"Создана категория № $id","status"=>"succes");
else
	$response=array("msg"=>"Не удалось создать категорию!","status"=>"error");	
echo json_encode($response);