<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly
}

get_header("shop");
?>

<?php
$id = get_the_ID();
$product = wc_get_product($id);
?>

<section class="box-product-detail py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="flex">
			<div class="basis-1/2 max-w-[50%] flex-none pr-4">
				<?php
				$attachment_ids = $product->get_gallery_image_ids();

				if ($attachment_ids) {
				?>
					<div class="swiper product-gallery-slide">
						<div class="swiper-wrapper">
							<?php
							foreach ($attachment_ids as $attachment_id) {
								$image_link = wp_get_attachment_url($attachment_id);
							?>
								<div class="swiper-slide">
									<a href="<?= $image_link ?>" data-fancybox="gallery">
										<img src="<?= $image_link ?>" alt="<?= esc_html(get_the_title()) ?>" class="aspect-square object-cover lazy">
									</a>
								</div>
							<?php } ?>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-pagination"></div>
					</div>
				<?php } ?>
			</div>
			<div class="basis-1/2 max-w-[50%] flex-none pl-4">
				<?php
				if (function_exists('custom_breadcrumb')) {
					echo custom_breadcrumb();
				}
				?>
				<h1 class="text-2xl font-semibold relative before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0 pb-3"><?php the_title() ?></h1>
				<span class="price block center font-semibold text-xl my-6">
					<?= $product->get_price_html() ?>
				</span>
				<div class="box-button mb-6">
					<button data-nonce="<?= wp_create_nonce('add_to_cart') ?>" data-product-id="<?= $id ?>" type="button" class="btn btn-add uppercase px-4 py-2 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-gray-100 duration-300 font-medium text-sm"><?php _e('Thêm vào giỏ hàng', 'core'); ?><i class="fa-solid fa-cart-plus ml-2"></i></button>
					<button data-nonce="<?= wp_create_nonce('add_to_cart') ?>" data-product-id="<?= $id ?>" type="button" class="btn btn-buy uppercase px-4 py-2 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-gray-100 duration-300 font-medium text-sm"><?php _e('Mua ngay', 'core'); ?><i class="fa-solid fa-money-check-dollar ml-2"></i></button> <br>
					<button data-nonce="<?= wp_create_nonce('add_to_wishlist') ?>" class="btn btn-wish uppercase px-4 py-2 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-gray-100 duration-300 font-medium mt-1 text-sm" data-product-id="<?= $id ?>" data-product-type="<?= esc_attr($product->get_type()); ?>" data-original-product-id="<?= ($product->get_parent_id()) ? esc_attr($product->get_parent_id()) : esc_attr($id) ?>" data-title="Wish list"><?php _e('Yêu thích', 'core'); ?><i class="fa-solid fa-heart ml-2"></i></button>
				</div>
				<div class="categories text-sm border-dashed border-slate-300 border-t-[1px] py-2">
					<?php $categories = get_the_terms($id, 'product_cat');
					if (!empty($categories)) { ?>
						<span><?php _e('Categories: '); ?></span>
						<?php foreach ($categories as $category) { ?>
							<a href="<?= get_term_link($category->term_id) ?>"><?= $category->name ?>,</a>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="categories text-sm border-dashed border-slate-300 border-t-[1px] py-2">
					<?php $tags = get_the_terms($id, 'product_tag');
					if (!empty($tags)) { ?>
						<span><?php _e('Tags: '); ?></span>
						<?php foreach ($tags as $tag) {	?>
							<a href="<?= get_term_link($tag->term_id) ?>"><?= $tag->name ?>,</a>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="social-share mt-3">
					<a href="https://www.facebook.com/sharer.php?u=<?= get_the_permalink() ?>" target="_blank" class="inline-flex items-center justify-center w-[24px] h-[24px] hover:bg-black hover:text-white transition-all border-[1px] border-black mr-1">
						<i class="fa-brands fa-facebook-f"></i>
					</a>
					<a target="_blank" href="http://twitter.com/share?url=<?= get_the_permalink() ?>" class="inline-flex items-center justify-center w-[24px] h-[24px] hover:bg-black hover:text-white transition-all border-[1px] border-black mr-1">
						<i class="fa-brands fa-square-x-twitter"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="product-desc mt-12">
			<div class="desc-head border-t-[1px] border-slate-300 mb-3">
				<div class="inline-block text-lg uppercase font-semibold relative before:content-[''] before:w-[100%] before:h-[2px] before:bg-gray-500 before:absolute before:top-[-1px] before:left-0 pt-2"><?php _e('Mô tả', 'core'); ?></div>
			</div>
			<div class="desc-body text-sm">
				<?php the_content() ?>
			</div>
		</div>
		<div class="related-product mt-12 pb-12 border-b-[1px] border-slate-300">
			<div class="related-head border-t-[1px] border-slate-300 mb-3">
				<div class="inline-block text-lg uppercase font-semibold relative before:content-[''] before:w-[100%] before:h-[2px] before:bg-gray-500 before:absolute before:top-[-1px] before:left-0 pt-2"><?php _e('Có thể bạn sẽ thích', 'core'); ?></div>
			</div>
			<?php
			$terms = $product->get_category_ids();

			$args = array(
				'post_type' => 'product',
				'posts_per_page' => 12,
				'post_status' => 'publish',
				'post__not_in' => array(get_the_ID()),
				'tax_query' => array(
					array(
						'field' => 'id',
						'taxonomy' => 'product_cat',
						'terms' => $terms,
					)
				),
				'order' => 'DESC',
			);


			$sheets = new WP_Query($args);
			?>
			<div class="related-product-slide swiper">
				<div class="swiper-wrapper">
					<?php
					while ($sheets->have_posts()) {
						$sheets->the_post()
					?>
						<div class="swiper-slide">
							<?php get_template_part('template-parts/components/products/sheet-item'); ?>
						</div>
					<?php }
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_template_part("template-parts/home/section2"); ?>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		let productGallerySlide = new Swiper(".product-gallery-slide", {
			slidesPerView: 1,
			speed: 800,
			autoplay: false,
			spaceBetween: 16,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
		});

		let relatedProductSlide = new Swiper(".related-product-slide", {
			slidesPerView: 4,
			spaceBetween: 16,
			speed: 800,
			autoplay: {
				delay: 5000,
			},
		});

		Fancybox.bind('[data-fancybox="gallery"]', {
			// Your custom options for a specific gallery
		});
	})
</script>

<?php get_footer("shop");

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
