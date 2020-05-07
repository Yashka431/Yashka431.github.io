<?php
  class Application_Controllers_Order extends Lib_BaseController
  {  
    function __construct()
	 {				
		$this->dislpay_form = true; // показывать форму ввода данных
			if(isset($_REQUEST["to_order"])){  // если пришли данные с формы
				$model = new Models_Order;	//создаем модель заказа
				$error=$model->isValidData($_REQUEST);  //проверяем на корректность вода
				if($error){$this->error=$error;} // если есть ошиби заносим их в переменную 
				else{			
					//если ошибок нет, то добавляем заказ в БД
					$order_id=$model->addOrder();
					Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
					header('Location: /order?thanks='.$order_id.'&pay='.$model->payment."&summ=".$model->summ);
					exit;
				}
			}
			
			if(isset($_REQUEST["thanks"]) &&!$error){
			   //формируем сообщение 
					$this->message="Ваша заявка <strong>№ ".$_REQUEST["thanks"]."</strong> принята";
					$this->order=$_REQUEST["thanks"];
					$this->summ=$_REQUEST["summ"];
					$this->payment=$_REQUEST["pay"];
					$this->dislpay_form = false;//  форму ввода данных больше не покзываем
			}
			
			if(isset($_REQUEST["payment"])&&!$error){
			    $this->dislpay_form = false;
				if($_REQUEST["payment"]=="success")
					$this->message="Вы успешно оплатили заказ!";		
				else	
					$this->message="Платеж не удался!<br/> Попробуйте снова, перейдя по ссылке из письма с уведомлением о принятии вашего заказа.";				
			}
			
	 }
  }
