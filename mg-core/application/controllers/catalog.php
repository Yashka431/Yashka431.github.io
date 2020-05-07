<?php
//контролер обрабатывает данные каталога
  class Application_Controllers_Catalog extends Lib_BaseController
  {
     function __construct()
	 {	
		 if($_REQUEST['in-cart-product-id']) // если нажата кнопка купить
			{
				$cart=new Models_Cart;
				$cart->addToCart($_REQUEST['in-cart-product-id']);
				Lib_SmalCart::getInstance()->setCartData();
				header('Location: /cart');
				exit;
			}
			if(isset($_POST['reset_filter'])){$_POST['filter']='';unset($_POST['reset_filter']);}
	
			
			$page=1;//показать первую страницу выбранного раздела
			$step=$_SESSION['settings']['count-catalog-product'];//сколько выводить на странице объектов	
			if(!is_numeric($step) || $step<1)$step=1;
			$product_sub_category=1;	
			
			if(isset($_REQUEST['p'])){ //запрашиваемая страница
				$page=$_REQUEST['p'];
			}
		
			$model=new Models_Catalog; // модель каталога
			
			//получаем список вложенных категорий, для вывода всех продуктов, на страницах текущей категории.
			$model->category_id=Lib_Category::getInstance()->getCategoryList($_REQUEST['category_id']);
			$model->category_id[]=$_REQUEST['category_id'];// в конец списка, добавляем корневую текущую категорию
			//print_r($_POST);
			
			if(isset($_POST['filter'])){
			unset($_POST['filter']);
			$model->user_filter=$_POST;	
			$_SESSION['user_filter']=$_POST;
			}else
			{
			$model->user_filter=$_SESSION['user_filter'];
			}
			
			
			
			
			$Items =$model->getPageList($page,$step);//передаем номер требуемой страницы, и количество выводимых объектов
		
			$this->pager=$Items['pagination'];
			unset($Items['pagination']);

			$this->TiteCategory=$model->current_category["title"];//наименование текущей категории
			$this->Items=$Items;//список продуктов выводимых в этой категории
		
	}
  }