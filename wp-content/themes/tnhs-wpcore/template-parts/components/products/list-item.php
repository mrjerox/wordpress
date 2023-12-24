<?php
	$id = get_the_ID();
	$product = wc_get_product($id);
	$img_url = get_the_post_thumbnail_url($id, 'full') ? get_the_post_thumbnail_url($id, 'full') : 'https://picsum.photos/500'
?>

<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
	<a href="<?php the_permalink();?>" class="block other-img max-w-[65px]">
		<img src="<?=$img_url?>" alt="Lewlew" class="aspect-square object-cover lazy">
	</a>
	<div class="item-body pl-4">
		<a href="<?php the_permalink();?>" class="item-title text-sm"><?php the_title();?></a>
		<span class="price block center font-semibold text-xs">
		<?= $product->get_price_html()?>
		</span>
	</div>
</div>