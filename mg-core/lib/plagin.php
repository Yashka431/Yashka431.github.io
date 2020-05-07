<?php
class Lib_Plagin
{
   function getPlaginsList(){
   
	$dir = $_SERVER['DOCUMENT_ROOT']."/mg-plugins/";
	$name = scandir($dir);
	
	echo "<ul class='plagin-list'>";
	for($i=2; $i<=(sizeof($name)-1); $i++) {
	
		echo "<li name='".$name[$i]."'>".ucfirst($name[$i])."</li>";
	}
	echo "</ul>";
   }
}