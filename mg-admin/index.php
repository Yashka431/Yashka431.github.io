<?
session_start(); //открываем сессию
?>
<link rel="stylesheet" href="design/style.css" type="text/css" />
<?if($_SESSION["Auth"] && $_SESSION["role"]=="1"):?>
<html>

  <head>
	<script type="text/javascript" src="../mg-core/script/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../mg-core/script/admin/admin.js"></script>
  </head>
  
  <body>
 
	<div id="admin-header">
		<div class="logo"></div>		
			<div class="menu">
			<ul>
				<li><a href="/" id="look"><span class="look">Просмотр</span></a></li>
				<li><a href="#" id="product"><span class="products">Уроки</span></a></li>
				<li><a href="#" id="category"><span class="category">Категории</span></a></li>
				<li><a href="#" id="settings"><span class="settings">Настройки</span></a></li>
			</ul>
		</div>
		<div class="user">
			<a href="#"><?=$_SESSION["User"]?></a> (<a href="/enter?out=1">Выход</a>)
		</div>
	</div>
	
	
	<div id="msg_error" class="message_error error">
		<span>Сообщение об ошибке!</span>
	</div>
	
	<div id="msg_succes" class="message_succes succes">
		<span>Дейсвие выполнено!</span>
	</div>
	
	<div id="msg_alert" class="message_alert alert">
		<span>Предупреждение!</span>
	</div>
	
	<div id="msg_information" class="message_information inform">
		<span><b>Wartortle</b> приветствует Вас!<br/>Начните управлять сайтом с раздела "Настройки", указав e-mail администратора и электронные кошельки для оплаты товаров! </span>
	</div>
	

	<div id="content">
		<div class="data">
		
		</div>
	</div>

  </body>
  
</html>
<?else:?>
<div class="login_form">
<div class="login-box-wrap">
<h2><span>Авторизация</span></h2>
<div class="info">
<?if(!$_SESSION["Auth"]){
echo "Только администраторы могут пользоваться этим разделом!";
}
else 
{
if($_SESSION["role"]>1) echo "У вас нет доступа к этой части сайта!";
}?>
<br />
<br />
<span>Введите логин и пароль администратора:</span>
</div>

<div class="login-action">
<form action="/enter" method="POST">
<table id="login_form_table" style="margin-top:10px; width: 100%;">
<tr>
  <td><input type="text" class="input_action user_ico" name="login" placeholder="Логин" value="<?=$login?>" /></td>
</tr>
<tr>
  <td><input type="text" class="input_action pass_ico" placeholder="Пароль" name="pass" value="<?=$pass?>" /></td>
</tr>
<tr>
  <td><div class="remember_me_box"><input type="checkbox" /><label>Запомнить меня</label></div></td>
</tr>
<tr>
<td colspan="2">
  <input type="hidden" name="location" value="/mg-admin" />
  <input class="enter_but" type="submit" value="Вход" />
</td>  
</tr>  
</table>  
</form>
</div>
<?endif;?>
</div>
</div>