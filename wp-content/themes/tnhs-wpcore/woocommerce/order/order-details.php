<?php

/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (!$order) {
	return;
}

$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>

<?php if ( is_wc_endpoint_url( 'order-received' ) && $order->get_status() !== 'completed' ) { ?>
	<section class="woocommerce-order-details">
		<?php do_action('woocommerce_order_details_before_order_table', $order); ?>

		<?php
		do_action('woocommerce_order_details_before_order_table_items', $order);

		foreach ($order_items as $item_id => $item) {
			$product = $item->get_product();
		} ?>

		<div class="mt-6 w-full justify-center md:flex md:space-x-6 xl:px-0">
			<div class="rounded-lg w-full">
				<?php do_action('woocommerce_before_cart_contents'); ?>
				<?php
				foreach ($order_items as $item_id => $item) {
					$product = $item->get_product();
				?>
					<div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
						<div class="cart-product-img">
							<?= $thumbnail = $product->get_image(); ?>
						</div>
						<div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
							<div class="mt-5 sm:mt-0">
								<a href="<?=$product->get_permalink()?>">
									<h2 class="text-lg font-bold text-gray-900">
										<?= $product->get_title(); ?>
									</h2>
								</a>
								<p class="mt-1 text-xs text-gray-700">
									<?php echo $product->get_categories(); ?>
								</p>
							</div>
						</div>
						<div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
							<div class="flex items-center space-x-4">
								<p class="text-sm">
									<?=$product->get_price_html()?>
								</p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php do_action('woocommerce_order_details_after_order_table_items', $order);
		?>

		<?php do_action('woocommerce_order_details_after_order_table', $order); ?>
	</section>
<?}?>
<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action('woocommerce_after_order_details', $order);

if ($show_customer_details) {
	wc_get_template('order/order-details-customer.php', array('order' => $order));
}
