<?
$model=new Models_Product;	
if($model->deleteProduct($_POST['id']))
	$response=array("msg"=>"Удален товар № {$_POST['id']}","status"=>"succes");
else
	$response=array("msg"=>"Не удалось удалить товар!","status"=>"error");	
echo json_encode($response);
?>