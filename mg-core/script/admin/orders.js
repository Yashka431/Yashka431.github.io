

		//Обработка  нажатия кнопки сохранения редактированной информации категории
		$('a[rel=save_orders]').live("click", function(){
			
		//собираем из таблицы все инпуты с данными, записываим их в виде нативного кода
			var obj ='{"url":"action/save_orders.php",';
			$('#table_order td[id=data] input').each(function(){
			obj+='"'+$(this).attr('name')+'":"'+$(this).val()+'",';
			});	
			obj+='}';
		//преобразуем полученные данные в JS объект для передачи на сервер
		var data1 = eval("(" + obj + ")");
	
		
			$.ajax({                
						type:"POST",
						url: "ajax.php",
						data: data1,
						cache: false,  
						success: function(data){		
							var response = eval("(" + data + ")");		
							indication(response.msg, response.status);
						
						
					
						$('.edit_order').animate({ opacity: "hide" }, "slow" );
						
						} 
					}); 
			
		
		});
		
		
	
		var select="#E3E9FF";
		var  background;

		$("#table_order tr").live("mouseover", function(){	
			background=$(this).find("td").css("background");		
			$(this).find("td").css('background',select);
		});
		  
		$("#table_order tr").live("mouseout", function(){			
			$(this).find("td").css('background',background);
		});  
		
		
		$('#table_order tr').live("click", function(){		
		var order_id = $(this).attr('order_id');
		$('.content_order').html($(this).find('.order_content').html());
		centerPosition($('.edit_order')); 
		$('.edit_order').animate({ opacity: "show" }, "slow" );
		$('.edit_order #order_id').text($(this).attr('order_id'));
		
		if($('#table_order tr[order_id='+order_id+'] td[id=paid]').text()=='Y')
		$('.edit_order #paid input[name=paid]').attr('checked', 'checked');
		
		if($('#table_order tr[order_id='+order_id+'] td[id=close]').text()=='Y')
		$('.edit_order #close input[name=close]').attr('checked', 'checked');
		
		});

		
		
		$('a[rel=cancel_edit_order]').live("click", function(){
		$('.edit_order').animate({ opacity: "hide" }, "slow" );
		$('.edit_order #paid input[name=paid]').removeAttr("checked");
		$('.edit_order #close input[name=close]').removeAttr("checked");
		});
		
		
		$('a[rel=save_edit_order]').live("click", function(){		
		alert(1);
		if($('.edit_order #close input[name=close]').attr('checked')=='checked')
		var close=1;
		else
		var close=0;
		
		if($('.edit_order #paid input[name=paid]').attr('checked')=='checked')
		var paid=1;
		else
		var paid=0;
		
		var order_id=$('.edit_order #order_id').text();
		
			$.ajax({                
						type:"POST",
						url: "ajax.php",
						data: {url:"action/save_orders.php",order_id:order_id,close:close,paid:paid},
						cache: false,  
						success: function(data){		
							var response = eval("(" + data + ")");		
							indication(response.msg, response.status);
					
							$('.edit_order').animate({ opacity: "hide" }, "slow" );
							$('.edit_order #order_id').text('');
							//$('#table_order tr[order_id=85] td[id=paid]').css('background','red');
							if(paid)str_paid='Y'; else str_paid='N';
							$('#table_order tr[order_id='+order_id+'] td[id=paid]').text(str_paid);
							if(close)str_close='Y'; else str_close='N';							
						    $('#table_order tr[order_id='+order_id+'] td[id=close]').text(str_close);
						
							$('.edit_order #paid input[name=paid]').removeAttr("checked");
							$('.edit_order #close input[name=close]').removeAttr("checked");
		
						} 
					}); 
		

	
		
		
		});
		