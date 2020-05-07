<h1>Уроки по курсам (Теория)</h1>
<? title($TiteCategory);
//представление каталога (страница каталога)
foreach($Items as $item)
		{
			if($i%3==0):?> 
			<div style="clear:both;"></div>
			<?endif;?>
			<div class="product">
				<div class="product_image">
					<a href="/<?=$item["category_url"]?>/<?=$item["product_url"]?>"><image src="/uploads/<?=$item["image_url"]?>" /></a>
				</div>
				<h2>
				<a href="/<?=$item["category_url"]?>/<?=$item["product_url"]?>"><?=$item["name"]?></a>
				</h2>
			</div>

		<?
			$i++;
		}
		
		echo $pager;
		?>
	
<!-- hjjjjjjjjjj
dfd
gd
gc_disabledg
gc_disabledggd
dns_get_mxdg
d
gc_disabledggddg
dns_get_mxdg
dns_get_mxdgdg
dns_get_mxdgdgdg
dns_get_mxdgdgdg
dns_get_mxdgdgdg
dns_get_mx
dns_get_mxdgdggd
dns_get_mxdgdggd
gc_disablegd
gd
d
gc_disabledggddg
dns_get_mxdgdgdg
dns_get_mxdgdgdgdg
dns_get_mxdgdgdggd
gc_disablegd

dns_get_mxdgdgdggd
gc_disabledggdgd

dns_get_mxdgdgdgdg
dns_get_mxdgdgdgdg
gc_disabledggddg

dns_get_mxdgdgdgdg
dns_get_mxdgdgdgdgdg
dns_get_mxdgdgdgdgdgdg
dns_get_mxdgdgdgdgdgdgdg -->
