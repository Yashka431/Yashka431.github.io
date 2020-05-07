<?php
//контролер обрабатывает данные каталога
  class Application_Controllers_Product extends Lib_BaseController
  {
     function __construct()
	 {
	     $model=new Models_Product;
		 $product = $model->getProduct($_REQUEST['id']);	
		 $this->product=$product;
		
	 }
  }
