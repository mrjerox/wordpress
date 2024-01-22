<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */

?>

<div class="woo-account --my-account py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="my-account flex flex-wrap">
			<div class="woo-navigation flex-[100%] md:flex-[30%] lg:flex-[20%] md:pr-4">
				<?php do_action( 'woocommerce_account_navigation' );?>
			</div>
			<div class="woocommerce-MyAccount-content flex-[100%] md:flex-[70%] lg:flex-[80%] md:pl-4 mt-6 md:mt-0">
				<?php
					/**
					 * My Account content.
					 *
					 * @since 2.6.0
					 */
					do_action( 'woocommerce_account_content' );
				?>
			</div>
		</div>
	</div>
</div>

