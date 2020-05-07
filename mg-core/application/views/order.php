<?if($dislpay_form):?>
<h1>Оформление заказа</h1>
<a href="/cart"><<< Назад в корзину</a>
<?else:?>
<h1>Оплата заказа</h1>
<?endif;?>
<br/>
<?if($error){ echo $error;}?><br/>
<?
//echo $dislpay_form;
if($dislpay_form){?>
<form action="" method="post">
<table class="table_order_form"> 
<tr bgcolor="#F2F2F2"><td>Ф.И.О.</td><td><input type="text" name="fio" value="<?=$_REQUEST['fio']?>"/></td></tr>
<tr bgcolor="lightgray"><td>E-mail<span style="color: red;">*</span></td><td><input type="text" name="email" value="<?=$_REQUEST['email']?>"/></td></tr>
<tr bgcolor="#F2F2F2"><td>Телефон</td><td><input type="text" name="phone" value="<?=$_REQUEST['phone']?>"/></td></tr>
<tr bgcolor="lightgray"><td>Адрес</td><td><textarea name="adres"><?=$_REQUEST['adres']?></textarea></td></tr>
</table>
<br/>
<strong>Доставка</strong>
<table class="table_order_form"> 
<tr bgcolor="#F2F2F2"><td>Курьером</td><td><input type="radio" name="delivery" value="kurier"></td></tr>
<tr bgcolor="lightgray"><td>Почтой</td><td><input type="radio" checked="checked" name="delivery" value="pochta"></td></tr>
</table>
<br/>
<strong>Способ оплаты</strong>
<table class="table_order_form"> 

<tr bgcolor="#F2F2F2"><td>WebMoney</td><td><input type="radio" name="payment" value="webmoney"></td></tr>
<tr bgcolor="lightgray"><td>Яндекс.Деньги</td><td><input type="radio"  name="payment" value="yandex"></td></tr>
<tr bgcolor="#F2F2F2"><td>Наложенный платеж</td><td><input type="radio" checked="checked" name="payment" value="platezh"></td></tr>
<tr bgcolor="lightgray"><td>Наличные (курьеру)</td><td><input type="radio" name="payment" value="nal2kurier"></td></tr>

</table>
<br/><br/>
<input type="submit" name="to_order" value="Оформить заказ">
</form>
<?}
else{ echo "<span style='color:green'>".$message."</span>"; 
echo "<hr/>";
echo "<p>Оплатить заказ <b>№ $order</b> на сумму <b>$summ</b> руб. </p>"; 
if($payment=='webmoney')
include('mg-pages/webmoney/pay.php');
if($payment=='yandex')
include('mg-pages/yandex/pay.php');

};
?>
