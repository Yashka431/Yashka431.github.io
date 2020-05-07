
		//Обработка  нажатия кнопки сохранения редактированной информации категории
		$('.plagin-list li').live("click", function(){
		show($(this).attr("name")+".php","plugin");		
		});
		