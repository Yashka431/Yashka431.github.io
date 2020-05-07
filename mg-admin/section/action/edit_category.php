<?

$id=$_POST['id'];
unset($_POST['id']);
if(Lib_Category::getInstance()->editCategory($id,$_POST))
	$response=array("msg"=>"Изменена категория № $id","status"=>"succes");
else
	$response=array("msg"=>"Не удалось изменить категорию!","status"=>"error");	
echo json_encode($response);