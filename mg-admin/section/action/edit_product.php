<?

$model=new Models_Product;	
$id=$_POST['id'];

unset($_POST['url']);
unset($_POST['id']);



if($model->updateProduct($_POST,$id))
	$response=array("msg"=>"Товар изменен","status"=>"succes");
else
	$response=array("msg"=>"Не удалось изменить параметры товара!","status"=>"error");	
echo json_encode($response);
