<?php
//Модель оформления заказа
 class Models_Order // наследует все методы класса для работы с бд
  {	  
		private $fio;
		private $email;
		private $phone;
		private $adres;
		
		// проверка на корректность ввода данных
		function isValidData($array_data){
			//корректность емайл
			if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['email'])){ 
			  $error="E-mail не существует!";	
			} 
			// заполненность адреса
			elseif(!trim($array_data['adres'])){ 
			  $error="Введите адресс!";	
			}
			//если нет ощибок, то заносим информацию в поля класса
			if($error)return $error;
			else{
				$this->fio=trim($array_data['fio']);
				$this->email=trim($array_data['email']);
				$this->phone=trim($array_data['phone']);
				$this->adres=trim($array_data['adres']);
				$this->delivery=$array_data['delivery'];
				$this->payment=$array_data['payment'];
				$cart = new Models_Cart();	
				$this->summ=$cart->getTotalSumm();
				return false;
			}		
     
		}
		
	//добавление заявки		
	function addOrder(){
		$date = mktime(); //текущая дата в UNIX формате
			
		$item_position = new Models_Product();
		//добавляем в массив корзины третий параметр  цены товара, для сохранения в заказ
		// это нужно для того чтобы в последствии вывести детальную информацию о заказе. 
		//Если оставить только id то информация может оказаться не верной, так как цены меняютмя.
		foreach($_SESSION['cart'] as $product_id=>$count){
			$product=$item_position->getProduct($product_id);
			$product_positions[$product_id] = array(
			"name"=>$product['name'],
			"code"=>$product['code'],
			"price"=>$product['price'],
			"count"=>$count,
			);
		}
		// сериализуем данные в строку для записи в бд
		$order_content=addslashes(serialize($product_positions));
		// создаем новую модель корзины чтобы узнать сумму заказа
		$cart = new Models_Cart();	
		$summ = $cart->getTotalSumm();
		
		//формируем массив параметров SQL запроса
		$array=array(
			"name"=>$this->fio, 
			"email"=>$this->email,
			"phone"=>$this->phone,
			"adres"=>$this->adres,
			"date"=>$date,
			"summ"=>$summ,
			"order_content"=>$order_content,
			"delivery"=>$this->delivery,
			"payment"=>$this->payment,
			"paid"=>"N",
			"close"=>"N",
		);
		
		
		// отдаем на обработку  родительской функции build_query
		DB::build_query("INSERT INTO `order` SET",$array);
		$id=DB::insert_id(); //заказ номер id добавлен в базу
		
		
		
		if($id) {
		if($this->payment=='webmoney'){
		$link="http://".$_SESSION['settings']['sitename']."/order?thanks=$id&pay=webmoney&summ=$summ";		
		}		
		if($this->payment=='yandex'){
		$link="http://".$_SESSION['settings']['sitename']."/order?thanks=$id&pay=yandex&summ=$summ";		
		}
		$subj="Оформлена заявка № $id на сайте".$_SESSION['settings']['sitename'];
		$table.="<br/>Имя: ".$this->fio;
		$table.="<br/>email: ".$this->email;
		$table.="<br/>тел: ".$this->phone;
		$table.="<br/>адрес: ".$this->adres;
		$table.="<br/>доставка: ".$this->delivery;
		$table.="<br/>оплата: ".$this->payment;
		$table.="<table>";
		foreach($product_positions as $product_id=>$product){
			$prod=$item_position->getProduct($product_id);			
			$table.="<tr><td>".$prod['code']."</td><td>".$prod['name']."</td><td>".$product['price']."</td><td>".$product['count']."</td></tr>";
			
		}
		$table.="</table>";
		$table.="<br/>К оплате:".$summ;
		
		$msg=$_SESSION['settings']['order-message']."<br/>".$table."
		<br/> Оплатить заказ вы можете перейдя по ссылке: ".$link;
		$this->sendMail($this->email,$subj,$msg,$id);
		$cart->clearCart();// если заказ успешно записан, то отчищаем корзину
		}
		
		
		return $id; // возвращаем номер заказа
	}
	
	
	
	function sendMail($to_user,$subject,$message,$id){
	
	$message=str_replace ("#ORDER#", $id, $message);
	$message=str_replace ("#SITE#", $_SESSION['settings']['sitename'], $message);
	$to_admin = $_SESSION['settings']['admin-email'];
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: admin@'.$_SESSION['settings']['sitename'].'.ru' . "\r\n";

	$mails = explode(",", $to_admin);
	
	foreach($mails as $mail)
	{
		if(preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $mail)){ 
			mail($mail, $subject, $message, $headers);	
		} 	
	}
	
	if (
	mail($to_user, $subject, $message, $headers)	
	)
	return true;
	else
	return false;
	
	}
  } 
