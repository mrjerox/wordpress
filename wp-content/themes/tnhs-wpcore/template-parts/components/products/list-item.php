<?php
	$id = get_the_ID();
	$product = wc_get_product($id);
	$title = get_the_title();
	$img_url = get_the_post_thumbnail_url($id, 'full') ? get_the_post_thumbnail_url($id, 'full') : 'https://picsum.photos/500'
?>

<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
	<a href="<?php the_permalink();?>" class="block other-img max-w-[65px] w-full">
		<img fetchpriority="low" width="65" height="65" data-src="<?=$img_url?>" alt="<?=esc_html($title)?>" src="<?=THEME_ASSETS . '/images/woocommerce-placeholder-300x300.png'?>" sizes="65px" class="aspect-square object-cover lazy">
	</a>
	<div class="item-body pl-4">
		<a href="<?php the_permalink();?>" class="item-title text-sm"><?= $title?></a>
		<span class="price block center font-semibold text-xs">
		<?= $product->get_price_html()?>
		</span>
	</div>
</div>