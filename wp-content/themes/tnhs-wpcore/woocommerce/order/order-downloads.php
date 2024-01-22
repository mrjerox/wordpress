<?php

/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<section class="woocommerce-order-downloads">
	<?php if (isset($show_title)) : ?>
		<h2 class="woocommerce-order-downloads__title"><?php esc_html_e('Downloads', 'woocommerce'); ?></h2>
	<?php endif; ?>

	<?php foreach ($downloads as $download) : 
		$product = wc_get_product($download['product_id']);	
	?>
		<div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
			<div class="cart-product-img">
				<?= $thumbnail = $product->get_image(); ?>
			</div>
			<div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
				<div class="mt-5 sm:mt-0">
					<a href="<?= $download['product_url'] ?>" class="text-lg font-bold text-gray-900">
						<?= $download['product_name'] ?>
					</a>
					<p class="mt-1 text-xs text-gray-700">
						<?php echo $product->get_categories(); ?>
					</p>
					<p class="mt-1 text-xs text-gray-700">
						<?php _e('Lượt tải: ', TEXTDOMAIN); echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'woocommerce' );?>
					</p>
					<p class="mt-1 text-xs text-gray-700">
						<?php 
							_e('Thời hạn: ', TEXTDOMAIN);
							if (!empty($download['access_expires'])) {
								echo esc_html(date_i18n(get_option('date_format'), strtotime($download['access_expires'])));
							} else {
								esc_html_e('Never', 'woocommerce');
							}
						?>
					</p>
				</div>
			</div>
			<div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
				<div class="flex items-center space-x-4">
					<a href="<?=$download['download_url']?>" class="text-sm whitespace-nowrap">
						<?php _e('Tải xuống', TEXTDOMAIN); ?>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</section>