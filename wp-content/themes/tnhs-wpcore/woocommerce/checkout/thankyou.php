<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
?>
<div class="checkout-page py-12">
	<div class=" container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<h2 class="title text-4xl font-bold text-dark"><?php _e('Đặt hàng thành công', TEXTDOMAIN);?></h2>
		</div>
		<?php
		if (function_exists('custom_breadcrumb')) {
			echo custom_breadcrumb();
		}
		?>

		<div class="woocommerce-order flex flex-wrap">
			<div class="left basis-[100%] max-w-[100%] md:basis-[70%] md:max-w-[70%] flex-none md:pr-4">
				<?php
				if ($order) :

					do_action('woocommerce_before_thankyou', $order->get_id());
				?>

					<?php if ($order->has_status('failed')) : ?>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
							<?php if (is_user_logged_in()) : ?>
								<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
							<?php endif; ?>
						</p>

					<?php else : ?>

						<?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

						<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

							<li class="woocommerce-order-overview__order order">
								<?php _e('Mã đơn: ', TEXTDOMAIN); ?>
								<strong><?php echo 'nncd' . $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?></strong>
							</li>

							<li class="woocommerce-order-overview__date date">
								<?php _e('Ngày đặt:', TEXTDOMAIN); ?>
								<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?></strong>
							</li>

							<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
								<li class="woocommerce-order-overview__email email">
									<?php esc_html_e('Email:', 'woocommerce'); ?>
									<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
											?></strong>
								</li>
							<?php endif; ?>

							<li class="woocommerce-order-overview__total total">
								<?php _e('Tổng tiền:', TEXTDOMAIN); ?>
								<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?></strong>
							</li>

							<?php if ($order->get_payment_method_title()) : ?>
								<li class="woocommerce-order-overview__payment-method method">
									<?php _e('Phương thức thanh toán:', TEXTDOMAIN); ?>
									<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
								</li>
							<?php endif; ?>
						</ul>

						<?php
							if (current_user_can('administrator')) { 
						?>

						<button id="btn-generate-paypal" type="button" class="btn !inline-flex items-center my-3 uppercase px-4 py-2 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-gray-100 duration-300 font-medium text-sm" data-url="<?=$order->get_meta('paypal_order_url')?>" data-nonce="<?=wp_create_nonce('update_order_meta_data_nonce')?>" data-order="<?=$order->get_id()?>" data-total="<?=round($order->get_total() / USD_RATE, 2)?>"><?php _e('Thanh toán bằng Paypal', TEXTDOMAIN); ?><i class="fa-brands fa-cc-paypal ml-2" style="font-size: 30px;"></i></button>

						<?php } ?>

					<?php endif; ?>

					<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
					<?php do_action('woocommerce_thankyou', $order->get_id()); ?>

				<?php else : ?>

					<?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>

				<?php endif; ?>
			</div>
			<div class="right basis-[100%] max-w-[100%] md:basis-[30%] md:max-w-[30%] flex-none md:pl-4 mt-6 md:mt-0">
				<img src="<?=THEME_ASSETS?>/images/bank.png" alt="Nguyễn Việt Tiến Momo">
				<img src="<?=THEME_ASSETS?>/images/bank2.jpeg" alt="Nguyễn Việt Tiến Techcombank">
			</div>
		</div>
	</div>
</div>

<script>
	window.addEventListener('DOMContentLoaded', () => {
		const btnCreatePayPalUrl = document.querySelector('#btn-generate-paypal');

		btnCreatePayPalUrl.addEventListener('click', async (e) => {
			e.preventDefault()
			let target = e.currentTarget

			if (target.getAttribute('data-url')) {
				let win = window.open(target.getAttribute('data-url'), '', 'height=800,width=576,popup=true')
				if(win.closed) {
					window.location.reload();
				}
				return
			}

			target.classList.toggle('pending')

			let response = await payPalCreateOrder(target.getAttribute('data-order'), target.getAttribute('data-total'))

			if (response.id) {
				target.remove()
				let data = {
					action: 'woocomerce_ajax_update_order_meta_data',
					nonce: target.getAttribute('data-nonce'),
					order_id: target.getAttribute('data-order'),
					paypal_order_id: response.id,
					paypal_order_url: response.links[1].href,
				}

				let updateOrderResponse = await post(data)
				console.log(updateOrderResponse);
				target.classList.toggle('pending')
				window.open(response.links[1].href, '', 'height=800,width=576,popup=true')
			}
			console.log(response)
		})
	})
</script>