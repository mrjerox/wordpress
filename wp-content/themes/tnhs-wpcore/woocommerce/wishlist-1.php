<?php

/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH\Wishlist\Templates\Wishlist
 * @version 3.0.0
 */

/**
 * Template Variables:
 *
 * @var $template_part string Sub-template to load
 * @var $var array Array of attributes that needs to be sent to sub-template
 */

if (!defined('YITH_WCWL')) {
	exit;
} // Exit if accessed directly
?>

<div class="product-list">
    <h1>??</h1>
	<?php
	if ($wishlist && $wishlist->has_items()) :
		foreach ($wishlist_items as $item) :
			global $product;
			$product = $item->get_product();
			if ($product && $product->exists()) : $product_id = $product->get_id();
	?>
				<?php get_template_part('template-parts/components/products/sheet-item');?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<?php if (!empty($page_links)) :
?>
	<div class="tw-pagination">
		<?php echo wp_kses_post($page_links); ?>
	</div>
<?php endif ?>
<?php //wp_nonce_field('add_button', 'add_button_nonce'); ?>