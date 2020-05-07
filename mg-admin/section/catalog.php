<script type="text/javascript" src="../mg-core/script/jquery.form.js"></script>	
	<script>
	$('#photoimg').live('change', function(){ 
			   $("#preview").html('');
			   $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
			   $("#imageform").ajaxForm({				
					target: '#preview'
				}).submit();
				
				$(".btn_cansel_load_img").css('display', 'block');
				$(".btn_load_img").css('display',  'none');	
		});	
		
	$('#edit_photoimg').live('change', function(){ 
			   $("#edit_preview").html('');
			   $("#edit_preview").html('<img src="loader.gif" alt="Uploading...."/>');
			   $("#edit_imageform").ajaxForm({				
					target: '#edit_preview'
				}).submit();
	});
	$("#category_select [value='<?=$category_id?>']").attr("selected", "selected");
	</script>	
<?
	$model=new Models_Catalog;	
	$catalog=array();
	
	$model->category_id=Lib_Category::getInstance()->getCategoryList($category_id); // пять - id категории
	$model->category_id[]=$category_id;
	
	$catalog=$model->getList($page,5);
	//категории: 

	$list_categories=Lib_Category::getInstance()->getCategoryTitleList();
	$array_categories=$model->category_id=Lib_Category::getInstance()->getHierarchyCategory(0);	
	
	$categories="<select id='category_select' name='category'>";
	$categories.="<option selected value='0'>Все</option>";
	$categories.=Lib_Category::getInstance()->getTitleCategory($array_categories);	
	$categories.="</select>";

	$pagination=$catalog['pagination'];
	unset($catalog['pagination']);
	
//	echo "<pre>";
//	print_R($catalog);
//	echo "</pre>";
?>	

	
<div class="wrap">
	<div class="over_bg" >
		<div class="m-panel grid_5">
                	<div class="panel-header" >
                    	<span class="m-cat-24">Каталог уроков</span>
                    </div>
                    <div class="panel-body">
                    	<div class="panel-content">
	                    	<div style="width:100%;">
							<div class="toolbar">
							<div style="float: left; margin-top: 4px;"><a href="#" rel="creat_new_product" class="add_good"><span>Добавить урок</span></a></div>
							<div class="filter"><b>Категория уроков</b> <?=$categories?></div>
							</div>
								<table class="catalog_table" >
								<tr>
									<th>ID</th>
									<th>Категория</th>
									<th>Изображение</th>
									<th>Артикул</th>
									<th>Название</th>
									<th>Описание</th>
									<th>Цена</th>
									
									<th style="display:none">Материал</th>
									<th style="display:none">Фабрика</th>
									<th style="display:none">Цвет</th>
									<th style="display:none">Назначение</th>
									<th style="display:none">Размер</th>
									<th style="display:none">Тип</th>
									<th style="display:none">Страна</th>
									<th style="display:none">Поверхность</th>
									<th style="display:none">Рисунок</th>
									<th style="display:none">Стиль</th>
									<th></th>
									<th></th>
								</tr>	 
									<?foreach($catalog as $data){?>
								<tr id="<?=$data['id']?>">
									<td class="id"><?=$data['id']?></td>
									<td id="<?=$data['cat_id']?>" class="cat_id"><?=$list_categories[$data['cat_id']]?></td>
									<td class="image_url"><?if(!$data['image_url']){$data['image_url']="none.png";}?><img class="uploads" src="../uploads/<?=$data['image_url']?>"/></td>
									<td class="code"><?=$data['code']?></td>
									<td class="name"><?=$data['name']?></td>
									<td class="desc" id="<?=$data['id']?>"><?=$data['desc']?></td>
									<td class="price"><?=$data['price']?></td>
		
									<td class="material" style="display:none"><?=$data['material']?></td>
									<td class="factory" style="display:none"><?=$data['factory']?></td>
									<td class="color" style="display:none"><?=$data['color']?></td>
									<td class="destination" style="display:none"><?=$data['destination']?></td>
									<td class="size" style="display:none"><?=$data['size']?></td>
									<td class="type" style="display:none"><?=$data['type']?></td>
									<td class="country" style="display:none"><?=$data['country']?></td>
									<td class="surface" style="display:none"><?=$data['surface']?></td>
									<td class="picture" style="display:none"><?=$data['picture']?></td>
									<td class="style" style="display:none"><?=$data['style']?></td>
		
									<td><a href="#" rel="edit" id="<?=$data['id']?>">Редактировать</a></td>
									<td><a href="#" rel="del" id="<?=$data['id']?>">Удалить</a></td>
								</tr>
	<?}?>
								<tr class="pagination_box"><td colspan="9"><?=$pagination?></td></tr>
								</table>
								
	
	
	<div class="creat_product">
		<div class="popwindow">
			<div class="title_popwindow">
				<span class="m-cat-24">Новый урок</span>	
				<div class="close_popwindow">
				<a href="#" rel="cancel_creat_new_product" >
				
				</a>
			</div>
			</div>
			
		</div>
		<div class="creat_product_table">
		<table>	
		<tr>
			<td>Название:</td><td><input type="text" name="name"/></td>
			<td rowspan="4">Изображение:
			<div class="btn_load_img">
				<form id="imageform" method="post" enctype="multipart/form-data" action="loadimage.php">
				<input type="file" name="photoimg" id="photoimg" />
				</form>	
			</div>
			
			<div class="btn_cansel_load_img">
				<a href="#" id="form_del_img"  alt="Отменить" title="Отменить"><img  src="design/images/cancal_upload.png"/></a>
			</div>						
		
			
			<div id="preview"></div>
			</td>
		</tr>
		<tr><td>Артикул:</td><td><input type="text" name="code"/></td></tr>
		<tr><td>Цена:</td><td><input type="text" name="price"/> руб.</td></tr>
		<tr><td>Категория:</td><td>
				
				<select id='new_prod_category' name='category'>
				<option selected value='0'>Все</option>
				<?=Lib_Category::getInstance()->getTitleCategory($array_categories);?>	
				</select>
				
				</td></tr>
		<tr><td>Описание:</td><td colspan="2"><textarea name="description" style="width:100%; height: 150px;"></textarea></td></tr>
		<tr>
			<td colspan="3" style="height:40px; text-align:right;">
				<a href="#" rel="save_new_product" class="button" >Сохранить</a>
			</td>
		</tr>
		</table>
		</div>
	</div>
	
	<div class="edit_product">
			<div class="popwindow">
				<div class="title_popwindow">
					<span class="m-cat-24">Редактировать урок</span>
					<div class="close_popwindow">
					<a href="#" rel="cancel_edit_product" >
					</a>
				</div>
				</div>
			</div>	
			<div class="edit_product_table">
			<table>	
				<tr><td>Название:</td><td><input type="text" name="edit_name" /></td><td rowspan="4">Изображение:
				<div class="edit_btn_load_img">			
				<form id="edit_imageform" method="post" enctype="multipart/form-data" action="loadimage.php">
				<input type="file" name="edit_photoimg" id="edit_photoimg" />
				</form>			
				</div>
			
				<div class="edit_btn_cansel_load_img">
					<a href="#" id="edit_form_del_img"  alt="Отменить" title="Отменить"><img  src="design/images/cancal_upload.png"/></a>
				</div>
			
				<div id="edit_preview">
				
				</div>
				
				</td></tr>
				<tr><td>Артикул:</td><td><input type="text" name="edit_code"/></td></tr>
				<tr><td>Цена:</td><td><input type="text" name="edit_price"/> руб.</td></tr>
				
				
				<tr><td>Категория:</td><td>
				
				<select id='edit_category' name='category'>
				<option selected value='0'>Все</option>
				<?=Lib_Category::getInstance()->getTitleCategory($array_categories);?>	
				</select>
				
				</td></tr>
				
				<tr><td class="material">Материал:</td><td><input type="text" name="edit_material"/></tr>
				<tr><td class="factory">Фабрика:</td><td><input type="text" name="edit_factory"/></tr>
				<tr><td class="color">Цвет:</td><td><input type="text" name="edit_color"/></tr>
				<tr><td class="destination">Назначение:</td><td><input type="text" name="edit_destination"/></tr>
				<tr><td class="size">Размер:</td><td><input type="text" name="edit_size"/></tr>
				<tr><td class="type">Тип:</td><td><input type="text" name="edit_type"/></tr>
				<tr><td class="country">Страна:</td><td><input type="text" name="edit_country"/></tr>
				<tr><td class="surface">Поверхность:</td><td><input type="text" name="edit_surface"/></tr>
				<tr><td class="picture">Рисунок:</td><td><input type="text" name="edit_picture"/></tr>
				<tr><td class="style">Стиль:</td><td><input type="text" name="edit_style"/></tr>
				
				<tr><td>Описание:</td><td colspan="2"><textarea name="edit_description" style="width:100%; height: 150px;"></textarea></td></tr>
				<tr><td colspan="3" style="height:40px; text-align:right;">
				<a href="#" rel="save_edit_product" class="button" >Сохранить</a>
				</td></tr>
			</table>
			</div>
			<input type="hidden" name="edit_id"/>
							</div>
							
                        </div>
                    </div>
                </div>

	</div>

	
	</div>
</div>	
