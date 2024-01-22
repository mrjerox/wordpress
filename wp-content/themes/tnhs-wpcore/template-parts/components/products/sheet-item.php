<?php
	$id = !empty($args['id']) ? $args['id'] : get_the_ID();
	$product = wc_get_product($id);
	$title = !empty($args['id']) ? get_the_title($id) : get_the_title();
	$permalink = !empty($args['id']) ? get_the_permalink($id) : get_the_permalink();
	$img_url = get_the_post_thumbnail_url($id, 'full') ? get_the_post_thumbnail_url($id, 'full') : 'https://picsum.photos/500';
	$remove_url = $args['remove_url'] ? $args['remove_url'] : false; 
?>

<div class="sheet-item <?=$remove_url ? '--wishlist-item' : NULL?>">
	<a href="<?=esc_url($permalink)?>" class="sheet-img block">
		<img data-src="<?=esc_url($img_url)?>" class="aspect-square object-cover lazy" alt="<?=esc_html($title)?>">
	</a>
	<?php if ($remove_url) { ?>
		<a href="<?=$remove_url?>" class="btn-remove-wishlist"><i class="fa-solid fa-xmark"></i></a>
	<?php } ?>
	<div class="sheet-body mt-3 text-center">
		<a href="<?=esc_url($permalink)?>" class="sheet-title block text-sm text-center"><?=esc_html($title)?></a>
		<span class="price block center font-semibold text-sm mt-1">
			<?= $product->get_price_html()?>
		</span>
	</div>
</div>