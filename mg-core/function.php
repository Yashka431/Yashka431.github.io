<?php 
define('PATH_SITE', $_SERVER['DOCUMENT_ROOT']."/");//сервер
define('PATH_ADMIN', PATH_SITE."mg-admin");//корневая папка админки  


function __autoload ($class_name) //автоматическая загрузка кслассов
 {
    $path=str_replace("_", "/", strtolower($class_name));//разбивает имя класска получая из него путь

	/*ищет модели сначало в пользовательской папке, если не находит в папке ядра*/
//echo PATH_SITE.$path.".php";
	if(file_exists(PATH_SITE.$path.".php")){ 
	
		include_once(PATH_SITE.$path.".php"); //пользовательские модели
	}else{  

		$path=PATH_SITE."mg-core/".$path;
		
		if(strpos($path, "/models/")){ //для моделей поиска в папке ядра дописывается нужный путь. Проверка для определения что запрашивается именно модель а не контролер или вид
		 $path=str_replace("/models/", "/application/models/", $path);//разбивает имя класска получая из него путь
		}
		
		if(file_exists($path.".php")){   
		
			include_once($path.".php");//подключает php файл по полученному пути	
		}
		
		else{
		
			// если контролер не был обнаружен, проверяем нет ли среди статических страниц нужной
			preg_match_all("`controllers/(.*).php$`i",trim($path.".php"),$extention);
			//вырезаем имя файла 
			$static_page=PATH_SITE."mg-pages/".$extention[1][0].".php";
			
			print_gui($static_page);				
		}
	}
 }
	//устанавливает название страницы
	function  title($title){
	  $_SESSION['settings']['title']=$title;
	};
	
	//устанавливает заголовки страницы
	function  mgHead($title=false){
		if(!$title)$title=$_SESSION['settings']['title'];
		if(empty($title))$title=$_SESSION['settings']['sitename'];
		$title.=" | ".$_SESSION['settings']['sitename'];
		echo'
		<!--Заголовки определенные движком-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>'.$title.'</title>
		<link rel="stylesheet" href="'.PATH_TEMPLATE.'/css/style.css" type="text/css" />
		<!--/Заголовки определенные движком-->
		';
		if(!$admin_section){
		echo'<link rel="stylesheet" href="/mg-admin/design/style-adminbar.css" type="text/css" />';
		}
	}
	
	function  init_settings(){
		
		//инициализация настроек
		$sql = "SELECT  *  FROM setting WHERE active='Y'";
		$result = DB::query($sql);
		while($setting = DB::fetch_array($result))
		{
		$SETTINGS[$setting['option']]=$setting['value'];
		}	
		
		$path=$_SERVER['DOCUMENT_ROOT'].'/mg-templates/'.$_SESSION['settings']['template-name'].'/css/style.css';

		if (!file_exists($path)) {
			
			define('PATH_TEMPLATE', "/mg-templates/.default");//корневая папка шаблона 
		}
		else{
			
			define('PATH_TEMPLATE', "/mg-templates/".$_SESSION['settings']['template-name']);//корневая папка шаблона 
		}
		
		return $SETTINGS;
	}	

	function getMenu(){
		return Lib_Menu::getInstance()->getMenu();
	}

	function getSmalCart(){
		return Lib_SmalCart::getInstance()->getCartData();
	} 

	function loger($text, $mode = 'a+')
	{	
		$date = date("Y_m_d");
		$filename = "log_".$date.".txt";
		$string = date("d.m.Y H:i:s")." => $text"."\n";
		$f = fopen($filename,$mode);
		fwrite($f,$string);
		fclose($f);
	}
	
	function translitIt($str){
		  $tr = array(
				"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
				"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
				"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
				"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
				"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
				"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
				"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
				"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
				"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
				"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
				"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
				"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
				"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
				" "=> "_", "."=> "", "/"=> "_","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5",
				"6"=>"6","7"=>"7","8"=>"8","9"=>"9","0"=>"0"
			);
			return strtr($str,$tr);
	}

	function create_url($urlstr){
		if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
			$urlstr = translitIt($urlstr);
			$urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
			return $urlstr;
		}
		return false;
	} 
	
	function defender_xss($arr){
		$filter = array("<", ">");	
		 foreach($arr as $num=>$xss){
			$arr[$num]=str_replace ($filter, "|", $xss);
		 }
		return $arr;
	} 

	function print_gui($static_page=false){	
		global $router;
		global $member;
	
		if(isset($member)) //если контролер вернул какие-то переменные, то делаеми их доступными для публичной части
		  foreach ($member as $key => $value)
			{
				$$key= $value; 
			}
		// если запрашивается отображение элемента
		if(!$static_page){
		   ob_start(); 
			 
			$view=$router->getView();
			include ($view); 
			template_footer();
			
			$buffer = ob_get_contents();
			ob_end_clean();
			
			template_header();
			echo $buffer;
		}
		else{		
			
		//если статичная страница существует, то выводим ее в шаблон
			if(file_exists($static_page)){
			
			    ob_start(); 
				
				include ($static_page); 				
				template_footer();

				$buffer = ob_get_contents();
				ob_end_clean();
				
				template_header();
				echo $buffer;			
				
				exit;
				
			} 
			else{ //если страница отсутствует выводим страницу 404 ошибки из щаблона
			    header("HTTP/1.0 404 Not Found");
				title("Ошибка 404");
				template_header();
				include (PATH_SITE.PATH_TEMPLATE."/404.php"); 
				template_footer();
				exit;
							
			}		
			
		}
		return true;
	} 
	
	
	function template_header(){
			$menu=getMenu();//????? кудато убрать
			$smal_cart=getSmalCart();//????? кудато убрать
			$category_list=Lib_Category::getInstance()->getCategoryList_UL(0);//????? кудато убрать
			
			
			
				require_once $_SERVER['DOCUMENT_ROOT'].PATH_TEMPLATE."/header.php";

				if($_SESSION["Auth"] && $_SESSION["role"]=="1"){
						require_once PATH_ADMIN."/adminbar.php";
				}	
		}
		
	function template_footer(){
				require_once $_SERVER['DOCUMENT_ROOT'].PATH_TEMPLATE."/footer.php";
	}