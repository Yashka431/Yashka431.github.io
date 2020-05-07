	var select="#E3E9FF";
		var  background;

		$(".catalog_table tr").live("mouseover", function(){
			if(!$(this).hasClass('pagination_box')){
			background=$(this).find("td").css("background");		
			$(this).find("td").css('background',select);
			}
		});
		  
		$(".catalog_table tr").live("mouseout", function(){			
			if(!$(this).hasClass('pagination_box')){
			$(this).find("td").css('background',background);
			}
		});  
		
		
		$('.catalog_table tr').live("click", function(){
			
			var id=$(this).attr('id')
		        refresh_field(id);  
		});
		//очистка всех полей формы  редактирвания товара
	  	function clear_field_edit()  
        {  
			var edit_product=$(".edit_product");	
			edit_product.find("input[name=edit_id]").val('');
			edit_product.find("input[name=edit_name]").val('');
			edit_product.find("input[name=edit_code]").val('');
			edit_product.find("#edit_preview").html('');
			edit_product.find("input[name=edit_price]").val('');
			edit_product.find("textarea[name=edit_description]").val('');			
			$('input[name=edit_photoimg]').val('');
				
        }  
		
		//очистка всех полей форы добавления товара
		function clear_field_new_product()  
        {  
			var creat_product=$(".creat_product");		
			creat_product.find("input[name=name]").val('');
			creat_product.find("input[name=code]").val('');
			creat_product.find("#preview").html('');
			creat_product.find("input[name=price]").val('');
			creat_product.find("textarea[name=description]").val('');			
			$('input[name=photoimg]').val('');
        }  
		
	//установка знаений в поля для редактирования товара
	  	function refresh_field(id)  
        {  
			var edit_product=$(".edit_product");
			$(".edit_btn_cansel_load_img").css('display','none');
			$(".creat_product").hide();//скрываем другие окна
			centerPosition(edit_product);  
			edit_product.animate({ opacity: "show" }, 500 );//показываем блок редактирования
			
			
			var code_product = $("tr[id="+id+"]").find("td[class=code]").text();	
			var name_product = $("tr[id="+id+"]").find("td[class=name]").text();			
			var desc_product = $("tr[id="+id+"]").find("td[class=desc]").text();
			var price_product = $("tr[id="+id+"]").find("td[class=price]").text();
			var category_product = $("tr[id="+id+"]").find("td[class=cat_id]").attr('id');
			var image_url_product = $("tr[id="+id+"]").find("img[class=uploads]").attr('src');	
			var material = $("tr[id="+id+"]").find("td[class=material]").text();				
			var factory = $("tr[id="+id+"]").find("td[class=factory]").text();			
			var color = $("tr[id="+id+"]").find("td[class=color]").text();			
			var destination = $("tr[id="+id+"]").find("td[class=destination]").text();
			var size = $("tr[id="+id+"]").find("td[class=size]").text();
			var type = $("tr[id="+id+"]").find("td[class=type]").text();	
			var country = $("tr[id="+id+"]").find("td[class=country]").text();			
			var surface = $("tr[id="+id+"]").find("td[class=surface]").text();
			var picture = $("tr[id="+id+"]").find("td[class=picture]").text();
			var style = $("tr[id="+id+"]").find("td[class=style]").text();
			
			edit_product.find("input[name=edit_id]").val(id);
			edit_product.find("input[name=edit_name]").val(name_product);
			edit_product.find("input[name=edit_code]").val(code_product);
		
			edit_product.find("#edit_category [value='"+category_product+"']").attr("selected", "selected");
			
			
			$(".edit_btn_load_img").css('display','block');
			

			
			if(image_url_product!="../uploads/none.png"){		
			$(".edit_btn_load_img").css('display','none');
			edit_product.find("#edit_preview").html("<img src='"+image_url_product+"' width='100' height='100'/>");
			edit_product.find(".edit_btn_cansel_load_img").css('display','block');
		
			}
		
			edit_product.find("input[name=edit_price]").val(price_product);
			edit_product.find("textarea[name=edit_description]").val(desc_product);			
			edit_product.find("input[name=edit_material]").val(material);
			edit_product.find("input[name=edit_factory]").val(factory);
			edit_product.find("input[name=edit_color]").val(color);
			edit_product.find("input[name=edit_destination]").val(destination);
			edit_product.find("input[name=edit_size]").val(size);
			edit_product.find("input[name=edit_type]").val(type);
			edit_product.find("input[name=edit_country]").val(country);
			edit_product.find("input[name=edit_surface]").val(surface);
			edit_product.find("input[name=edit_picture]").val(picture);
			edit_product.find("input[name=edit_style]").val(style);
			
				
        }  
		
		//Обработка  выбора категории
		$('#category_select').live("change", function(){    
			var page= 1;
			var category_id=$(this).val();
	
			$.ajax({                
					type:"POST",
					url: "ajax.php",
					data: { url: "catalog.php",page:page,category_id:category_id},
					cache: false,  
					success: function(data){
						$("#content").html(data);  
					}  
				
			}); 
			
		});	
		
	/*Каталог*/ 
		
		//Обработка  нажатия кнопки перехода на другую страницу каталога
		$('a[rel=pagination]').live("click", function(){    
	
			var  page=$(this).attr('page');// интервал
			var category_id=$('#category_select').val();
			$.ajax({                
					type:"POST",
					url: "ajax.php",
					data: { url: "catalog.php",page:page,category_id:category_id},
					cache: false,  
					success: function(data){
						$("#content").html(data);  
					}  
				
			}); 
			
		});	
		
		//Обработка  нажатия кнопки создания нового товара
		$('a[rel=creat_new_product]').live("click", function(){
			$(".edit_product").hide();//скрываем открытые окна 
			centerPosition($(".creat_product"));  
			$(".creat_product").animate({ opacity: "show" }, 500 ); // показываем блок для создания нового товара
		}); 
		
		//Обработка  нажатия кнопки сохранения нового товара
		$('a[rel=save_new_product]').live("click", function(){
		
			var filepath=$('input[type=file]').val();//получаем путь до загружаемого файла 
			var arr= filepath.split('\\');//разбиваем его на части
			var filename=arr[arr.length-1];// берем только последнюю часть - название и расширение
	
			//далее проверка на заполненность полей
			var name=$.trim($(".creat_product").find('input[name=name]').val());
			var code=$.trim($(".creat_product").find('input[name=code]').val());
			var price=$.trim($(".creat_product").find('input[name=price]').val())-0;
			var cat_id=$("#new_prod_category").val();
			var desc=$.trim($(".creat_product").find('textarea[name=description]').val());
			var err=0;
			
		
	
			if(!code||!desc||!name){err="Все поля должны быть заполнены!";}
			else if((typeof price)!="number"||!price){err="Введите правильную цену!";}
			if(err!=0)
			{
				indication(err, "error");
			}
			else		
			$.ajax({                
						type:"POST",
						url: "ajax.php",
						data: {url: "action/add_product.php",name:name,cat_id:cat_id,code:code,price:price,desc:desc,image_url:filename},
						cache: false,  
						success: function(data){
							
							var response = eval("(" + data + ")");		
							indication(response.msg, response.status);
							$(".creat_product").hide();
						
							//переходим на последнюю страницу
						var  page=999;// интервал
						$.ajax({                
								type:"POST",
								url: "ajax.php",
								data: { url: "catalog.php",page:page,category_id:cat_id},
								cache: false,  
								success: function(data){
									$("#content").html(data);  
								}  
							
						}); 
						
						}
				
					}); 
		});
		
       	//Обработка  нажатия кнопки отмены создания нового товара		
		$('a[rel=cancel_creat_new_product]').live("click", function(){	
				clear_field_new_product();
				$(".creat_product").animate({ opacity: "hide" }, 500 );
		}); 
		
	

		//Обработка  нажатия кнопки редактирования  товара	
		$('a[rel=edit]').live("click", function(){
			var id=$(this).attr('id')
		        refresh_field(id);  
		}); 
	
			
		//Обработка  нажатия кнопки сохранения отредактированного товара	
		$('a[rel=save_edit_product]').live("click", function(){   
			var id=$.trim($('input[name=edit_id]').val());
			
			
			var filepath=$('input[name=edit_photoimg]').val();
			
			
			if(filepath!=""){
			var arr=filepath.split('\\');
			var image_url_product=arr[arr.length-1];				
			}
			else{
			var image_url_product = $("tr[id="+id+"]").find("img[class=uploads]").attr('src');	
			var arr=image_url_product.split('/');
			image_url_product=arr[arr.length-1];	
			}
		
		
			var material = $.trim($('input[name=edit_material]').val());			
			var factory = $.trim($('input[name=edit_factory]').val());			
			var color = $.trim($('input[name=edit_color]').val());		
			var destination = $.trim($('input[name=edit_destination]').val());
			var size = $.trim($('input[name=edit_size]').val());
			var type = $.trim($('input[name=edit_type]').val());
			var country = $.trim($('input[name=edit_country]').val());		
			var surface = $.trim($('input[name=edit_surface]').val());
			var picture = $.trim($('input[name=edit_picture]').val());
			var style = $.trim($('input[name=edit_style]').val());
			
		
			var name=$.trim($('input[name=edit_name]').val());
			var code=$.trim($('input[name=edit_code]').val());
			var price=$.trim($('input[name=edit_price]').val())-0;
			var cat_id=$("#edit_category").val();
			var desc=$.trim($('textarea[name=edit_description]').val());
			var err=0;
		
			if(!name||!code||!desc){err="Все поля должны быть заполнены!";}
			else if((typeof price)!="number"||!price){err="Введите правильную цену!";}
			
			if(err!=0)
			{
				indication(err,"error") ; 			
			}
		else	
		
			$.ajax({                
					type:"POST",
					url: "ajax.php",
					data: {url: "action/edit_product.php",
					id:id,
					name:name,
					code:code,
					cat_id:cat_id,
					price:price,
					desc:desc,
					image_url:image_url_product,
					 material:material,			
					 factory:factory,		
					 color:color,		
					 destination:destination,
					 size:size,
					 type:type,
					 country:country,	
					 surface:surface,
					 picture:picture,
					 style:style
					},
					cache: false,  
					success: function(data){
				
							var response = eval("(" + data + ")");		
							
							//indication($("#message"),response.msg, response.status);
							indication(response.msg, response.status);
							$(".edit_product").animate({ opacity: "hide" }, 500 );
								
							//вставляем  измененны данные в строку таблицы
							$("tr[id="+id+"]").find("td[class=code]").text(code);	
							$("tr[id="+id+"]").find("td[class=cat_id]").text($("#edit_category :selected").text());	
							$("tr[id="+id+"]").find("td[class=name]").text(name);			
							$("tr[id="+id+"]").find("td[class=desc]").text(desc);
							$("tr[id="+id+"]").find("td[class=price]").text(price);
							
							$("tr[id="+id+"]").find("td[class=material]").text(material);
							$("tr[id="+id+"]").find("td[class=factory]").text(factory);
							$("tr[id="+id+"]").find("td[class=color]").text(color);
							$("tr[id="+id+"]").find("td[class=destination]").text(destination);
							$("tr[id="+id+"]").find("td[class=size]").text(size);
							$("tr[id="+id+"]").find("td[class=type]").text(type);
							$("tr[id="+id+"]").find("td[class=country]").text(country);
							$("tr[id="+id+"]").find("td[class=surface]").text(surface);							
							$("tr[id="+id+"]").find("td[class=picture]").text(picture);
							$("tr[id="+id+"]").find("td[class=style]").text(style);
							
							
							$("tr[id="+id+"]").find("td[class=image_url]").html("");
							if(!image_url_product)image_url_product="none.png";
							$("tr[id="+id+"]").find("td[class=image_url]").html("<img class='uploads' src='../uploads/"+image_url_product+"' width='80' height='80'/>");
						
							clear_field_edit();  
					}
				
			}); 
		});
			
		
		//нажата кнопка отмены изображния в форме редакирования
		$('#edit_form_del_img').live('click', function(){ 
		var id=$.trim($('input[name=edit_id]').val());
	
		$("tr[id="+id+"]").find("img[class=uploads]").attr('src', '');	

			$.ajax({                
				type: "POST",
				url: "ajax.php",
				data: {url: "action/del_image.php",	 id: id },
                cache: false,  
                success: function(data){  
			        $("#edit_preview").html('');  	
					$(".edit_btn_load_img").css('display','block');
					$(".edit_btn_cansel_load_img").css('display','none');
					
                }  
            }); 
		});
		
		//нажата кнопка отмены изображния в форме добавления товара
		$('#form_del_img').live('click', function(){
			    $("#preview").html('');  	
			
				$('input[name=photoimg]').val('');
				$(".btn_cansel_load_img").css('display', 'none');
				$(".btn_load_img").css('display',  'block');					
            }  
        );  
		
		//Обработка  нажатия кнопки отмены редактирования  товара			
		$('a[rel=cancel_edit_product]').live("click", function(){	
				clear_field_edit();  
				$(".edit_product").animate({ opacity: "hide" }, 500 );
		}); 
		//Обработка  нажатия кнопки удаления  товара			
		$('a[rel=del]').live("click", function(){		
		
			var page=$("div.pagination").find("a[class=activ]").attr('page');
			var category_id=$('#category_select').val();
	
			$.ajax({                
						type:"POST",
						url: "ajax.php",
						data: {url: "action/delete_product.php",
						id:$(this).attr('id')			
						},
						cache: false,  
						success: function(data){	
						
							var response = eval("(" + data + ")");		
							indication(response.msg, response.status);
							
							$.ajax({                
							type:"POST",
							url: "ajax.php",
							data: { url: "catalog.php",page:page,category_id:category_id },
							cache: false,  
							success: function(data){
								$("#content").html(data);  
							}  
							}); 
					
						}
				
					}); 
		}); 