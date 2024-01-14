<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>

<div class="mx-auto max-w-5xl justify-center md:flex md:space-x-6 xl:px-0">
	<div class="rounded-lg md:w-2/3">
		<?php do_action('woocommerce_before_cart_contents'); ?>
		<?php
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
			/**
			 * Filter the product name.
			 *
			 * @since 2.1.0
			 * @param string $product_name Name of the product in the cart.
			 * @param array $cart_item The product in the cart.
			 * @param string $cart_item_key Key for the product in the cart.
			 */
			$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
		?>
				<div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
					<?php
					$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

					if (!$product_permalink) {
						echo $thumbnail; // PHPCS: XSS ok.
					} else {
						printf('<a href="%s" class="block cart-product-img">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
					}
					?>
					<!-- <img src="https://images.unsplash.com/photo-1515955656352-a1fa3ffcd111?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="product-image" class="w-full rounded-lg sm:w-40" /> -->
					<div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
						<div class="mt-5 sm:mt-0">
							<h2 class="text-lg font-bold text-gray-900">
								<?php
								if (!$product_permalink) {
									echo wp_kses_post($product_name . '&nbsp;');
								} else {
									/**
									 * This filter is documented above.
									 *
									 * @since 2.1.0
									 */
									echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
								}

								do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

								// Meta data.
								echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

								// Backorder notification.
								if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
									echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
								}
								?>
							</h2>
							<p class="mt-1 text-xs text-gray-700">
								<?php echo $_product->get_categories(); ?>
							</p>
						</div>
						<div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
							<div class="flex items-center space-x-4">
								<p class="text-sm">
									<?php
									echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</p>
							</div>
						</div>
					</div>
				</div>
		<?php }
		} ?>
	</div>
	<div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
		<div class="flex justify-between">
			<p class="text-lg font-bold"><?php _e('Tổng tiền', TEXTDOMAIN); ?></p>
			<div class="">
				<p class="mb-1 text-lg font-bold"><?php wc_cart_totals_order_total_html(); ?></p>
			</div>
		</div>
		<button type="button" id="btn-create-order" class="block text-center mt-6 w-full rounded-md bg-black py-1.5 font-medium text-blue-50 hover:bg-black-500">
			<?php _e('Thanh toán', TEXTDOMAIN); ?>
		</button>
	</div>
</div>

<style>
	#place_order {
		display: none;
	}
</style>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const btnCreateOrder = document.querySelector('#btn-create-order')
		btnCreateOrder.addEventListener('click', (e) => {
			e.preventDefault()
			document.querySelector('#place_order').click()
		})
	})
</script>