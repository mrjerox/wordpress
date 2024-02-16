<section class="box-hidden-cart" id="left-cart">
	<div class="overlay"></div>
	<div class="left-cart">
		<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0 hidden md:block"><?php _e('Giỏ hàng', TEXTDOMAIN); ?></h3>

		<div class="cart-item-list">
			<?php
			$cart_items = WC()->cart->get_cart();
			foreach ($cart_items as $key => $item) {
				$product = wc_get_product($item['product_id']);
				$images = wp_get_attachment_image_src(get_post_thumbnail_id($item['product_id'], 'full'));
			?>
			<div class="rounded-lg">
				<div class="mb-6 rounded-lg bg-white p-6 shadow-md relative">
					<button class="btn-remove-item absolute top-[0] right-[0] text-xs" data-id="<?=$item['product_id']?>" data-nonce="<?= wp_create_nonce('remove_cart_item')?>"><i class="fa-solid fa-xmark"></i></button>
					<a href="<?=$product->get_permalink()?>" class="block text-center cart-product-img text-center">
						<img src="<?=$images[0] ?>" alt="<?=$product->get_title()?>" class="block mx-auto lazy">
					</a>
					<div class="block">
						<div class="mt-5">
							<h2 class="text-sm font-bold text-gray-900">
								<a href="<?=$product->get_permalink()?>"><?=$product->get_title()?></a>
							</h2>
							<p class="mt-1 text-xs text-gray-700">
								<?=$product->get_price_html()?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		<div class="box-button">
			<a href="<?=wc_get_checkout_url()?>" class="block text-center mt-6 w-full rounded-md bg-black py-1.5 font-medium text-sm text-blue-50 hover:bg-black-500 ">Checkout</a>
		</div>
	</div>
</section>