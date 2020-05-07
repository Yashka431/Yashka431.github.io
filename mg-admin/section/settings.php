<?

$sql = "SELECT  *  FROM setting WHERE active='Y'";
$result = DB::query($sql);
$table_settings="<table id='table_settings'>";
while ($setting = DB::fetch_assoc($result))
		{		 

			$table_settings.="<tr><td >".$setting['name']."</td><td id='data'><input type='text' value='".$setting['value']."' name='".$setting['option']."'/></td><td>".$setting['desc']."</td></tr>";
			print_r($row);
		}
$table_settings.="
<tr class='pagination_box' style='height:60px;'><td colspan='3'>
	<a href='#' rel='save_settings' class='button'>Сохранить настройки</a>
</td><tr>
</table>";
?>
<div class="wrap">
	<div class="over_bg" >
		<div class="m-panel grid_5">
<div class="panel-header" >
    <span class="m-setting-24">Настройки системы</span>
</div>
<?echo $table_settings?>
</div>
</div>
</div>	