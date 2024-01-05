<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<!-- <div class="mb-2 flex justify-between">
		<p class="text-gray-700"><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?></p>
		<p class="text-gray-700"><?php //wc_cart_totals_subtotal_html(); ?></p>
	</div> -->
	<!-- <hr class="my-4" /> -->
	<div class="flex justify-between">
		<p class="text-lg font-bold"><?php esc_html_e( 'Total', 'woocommerce' ); ?></p>
		<div class="">
			<p class="mb-1 text-lg font-bold"><?php wc_cart_totals_order_total_html(); ?></p>
		</div>
	</div>
	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>