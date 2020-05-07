<?php

 class Models_Product
  {	  
	   function addProduct($array)
	  { 	
		$array['url']=	translitIt($array['name']);
		if(strlen($array['url'])>60)$array['url']=	substr($array['url'], 0, 60);
		//для чистоты работы, тут лучше проверить на уже существующие url,
			if(DB::build_query("INSERT INTO product SET ",$array)){
			    $id = DB::insert_id();
				return $id;
			}
		
		return	false;
	  }
	  
	
	  function updateProduct($array,$id)
	  { 

		if(DB::query("UPDATE product SET ".DB::build_part_query($array)." WHERE id = %d",$id)){			   
				return true;
			}
		return	false;
	  }
	  
	   function deleteProduct($id)
	  { 
		if(DB::query("DELETE FROM product WHERE id = %d",$id)){
		return true;
		}
		return	false;
	  }
	  
	  
	  function getProduct($id)
	  { 		
	  
		 $result=DB::query("SELECT * FROM `product` WHERE id='%d'",$id);	
		if(!empty($result)){
	 if($product = mysql_fetch_array($result)) 	{		  
		 return $product; 
		 }
		 else return array();
		 }
		
	  }
	  
	  function getProductPrice($id)
	  { 
		
		$sql = sprintf("SELECT price FROM product WHERE id='%d'", mysql_real_escape_string($id));
			
		 $result = mysql_query($sql)  or die(mysql_error());
	
		 if($row = mysql_fetch_object($result))
		 {	 		
			 return $row->price; 
		 }
		  return false; 
	  }
  } 
