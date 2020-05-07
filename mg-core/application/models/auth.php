<?php
//модель авторизации
 class Models_Auth
  {	  
	//проверка данных авторизации
	  function ValidData($login,$pass)
	  {

	    $sql = DB::query("SELECT * FROM `user` WHERE login='%s' and pass='%s'",$login,$pass);
	    if( DB::num_rows($sql))
		    { 
			$row=DB::fetch_assoc($sql);
			$_SESSION["Auth"]=true;  
			$_SESSION["User"]=$login;  
			$_SESSION["role"]=$row["role"];  
			} 
		else $_SESSION["Auth"]=false;  

		if (!$_SESSION["Auth"]){
			$msg="<em><span style='color:red'>Данные введены не верно!</span></em>";
		}	
		else {
			$msg="<em><span style='color:green'>Вы верно ввели данные!</span></em>";
			$unVisibleForm=true;
		}
		
		$result=array("unVisibleForm"=>$unVisibleForm,
						"userName"=>$login,
						"msg"=>$msg,
						"login"=>$login,
						"pass"=>$pass,);
		return $result;
		
	  }
  } 
