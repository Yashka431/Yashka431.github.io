<a href="/catalog"><<< Назад</a>
<h1><?=$product['name']?></h1>

<div class="card_product">
				<div class="product_image">
					<image src="/uploads/<?=$product['image_url']?>" alt="<?=$product['name']?>" title="<?=$product['name']?>" />
				</div>
				<div class="product_desc">
					<strong></strong>
					
					
					 <?=$product['desc']?>

				</div>
				<div class="product_buy">
				
					
				</div>
				<div class="product_com">
					<br><p>Добавить комментарий:</p>
					<input type="text" name="comment" placeholder="Напишите комментарий">
				
					
				</div>
</div>