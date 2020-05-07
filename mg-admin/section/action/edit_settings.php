<?
require_once $_SERVER['DOCUMENT_ROOT']."/mg-core/function.php";
unset($_POST['url']);
foreach($_POST as $option=>$value){
$sql = "UPDATE `setting` SET `value`='%s' Where `option`='%s'";
$result = DB::query($sql,$value,$option);
}
$response=array("msg"=>"Настройки сохранены","status"=>"succes");	
echo json_encode($response);