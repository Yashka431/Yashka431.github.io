<?
$model=new Models_Product;	
if($id=$model->addProduct($_POST))
	$response=array("msg"=>"Создан товар № $id","status"=>"succes");
else
	$response=array("msg"=>"Не удалось создать товар!","status"=>"error");	
echo json_encode($response);
