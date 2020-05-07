<?
//представление личного кабинета (страница личного кабинета)
if(!$unVisibleForm):?>
<h1>Вход в личный кабинет</h1>
<?endif;?>
<?

if(!$unVisibleForm):
echo $msg;
?>
<form class="login_pass" action="/enter" method="POST">
  Логин:  &nbsp;<input type="text" name="login" value="<?=$login?>" />   <br />
  Пароль: <input type="password" name="pass" value="<?=$pass?>" /><br /><br><input type="submit" value="Вход" />
</form>

<?else:?>
<h1>Личный кабинет пользователя <?=$userName?></h1>
<P>Прогресс в заданиях:<b class="bbb"> 0/100%</b></P><br>
<P>Прогресс в просмотре видеороликов:<b class="bbb"> 0/100%</b></P><br>
<P>Прогресс в тестах:<b class="bbb"> 0/100%</b></P><br>
<a class="logout" href="/enter?out=1">Выйти из кабинета!</a>

<?endif;?>
