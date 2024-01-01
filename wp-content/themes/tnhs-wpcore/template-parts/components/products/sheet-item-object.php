<?php
	$id = !empty($args['id']) ? $args['id'] : NULL;
    $product = wc_get_product($id);
	$title = get_the_title();
	$img_url = get_the_post_thumbnail_url($id, 'full') ? get_the_post_thumbnail_url($id, 'full') : 'https://picsum.photos/500'
?>

<div class="sheet-item">
	<a href="<?php the_permalink()?>" class="sheet-img block">
		<img data-src="<?=$img_url?>" class="aspect-square object-cover lazy" alt="<?=esc_html($title)?>">
	</a>
	<div class="sheet-body mt-3 text-center">
		<a href="<?php the_permalink()?>" class="sheet-title block text-sm text-center"><?=$title?></a>
		<span class="price block center font-semibold text-sm mt-1">
			<?= $product->get_price_html()?>
		</span>
	</div>
</div>