		
	$(document).ready(function(){

	//обработчики нажатий на ссылки в панеле
			$('a[id=product]').click(function(){show("catalog.php","adminpage"); $('#msg_information span').html("Раздел \"<b>Уроки</b>\" предназначен для создания и редактирования уроков.<br/> Добавьте новый Урок с помощью кнопки \"Добавить урок\"");});
			$('a[id=category]').click(function(){show("category.php","adminpage");$('#msg_information span').html("Раздел \"<b>Категории</b>\" предназначен для создания и редактирования списка категорий уроков.<br/> Добавьте категорию  спомощью кнопки \"Добавить категорию\".<br/>Для создания вложенных категорий и их редактирования кликните по названию нужной категории, и выберите нужный пункт в контекстном меню. ");});
			$('a[id=page]').click(function(){show("page.php","adminpage"); $('#msg_information span').html("Раздел \"<b>Страницы </b>\" предназначен для создания и редактирования статичных HTML страниц вашего сайта.<br/><b>Раздел в стадии разработки!</b>");});
			$('a[id=menu]').click(function(){show("menu.php","adminpage");});
			$('a[id=settings]').click(function(){show("settings.php","adminpage"); $('#msg_information span').html("Раздел \"<b>Настройки </b>\" предназначен для задания параметров сайта, влияющих на его работоспособность.");});
			$('a[id=orders]').click(function(){show("orders.php","adminpage"); $('#msg_information span').html("Раздел \"<b>Заказы</b>\" предназначен для обработки поступивших заказов вашего интернет магазина.<br/> Чтобы увидеть содержимое заказа кликните на строку в таблице.");});
			$('a[id=plugins]').click(function(){show("plugins.php","adminpage"); $('#msg_information span').html("Раздел \"<b>Плагины</b>\" предназначен для расширения возможностей администрирования сайта<br/> Чтобы получить доступ к работе с плагином кликните на интересующее вас название плагина из списка.");});
	});  	

	
	//запрашивает страницу для вывода 
		function show(url,type)  
        {  
            $.ajax({                
				type: "POST",
				url: "ajax.php",
				data: { url: url,type:type },
                cache: false,  
                success: function(data){  
			        $("#content").html(data);  
			
                }  
            });  
        }  
		
	  function indication(text,status)  
        {
				var background="#9abb8b";
				var bordercolor="#588a41";
			
				var object="";	
				if(status=="error"){			
				object=$('#msg_error');
				}
				
				if(status=="succes"){			
				object=$('#msg_succes');
				}
				if(status=="alert"){			
				object=$('#msg_alert');
				}
				if(status=="information"){			
				object=$('#msg_information');
				}
				
			
				object.animate({ opacity: "show" }, "slow" );
				object.html(text); 		
				object.animate({ opacity: "hide" }, 3000 );
				
		}
	
		//позиционирование элемента по центру окна
		function centerPosition(object)  
        {
			object.css('position', 'absolute');
			object.css('left', ($(window).width()-object.width())/2+ 'px');
			object.css('top', ($(window).height()-object.height())/2+ 'px');
		}
	
		
$.getScript('/mg-core/script/admin/catalog.js');
$.getScript('/mg-core/script/admin/category.js');
$.getScript('/mg-core/script/admin/settings.js');
$.getScript('/mg-core/script/admin/orders.js');
$.getScript('/mg-core/script/admin/plugins.js');


