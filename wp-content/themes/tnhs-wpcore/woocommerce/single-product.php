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

<section class="box-product-detail">
	<div class="container lg:max-w-screen-lg">
		<div class="flex">
			<div class="flex-1 w-25">
				<img src="https://picsum.photos/1000">
			</div>
			<div class="flex-1 w-50">
				<img src="https://picsum.photos/1000">
			</div>
		</div>
	</div>
</section>

<?php get_footer("shop");

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
