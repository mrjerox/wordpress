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

<section class="wishlist-page py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<h2 class="title text-4xl font-bold text-dark"><?= get_the_title(); ?></h2>
		</div>
		<?php
		if (function_exists('custom_breadcrumb')) {
			echo custom_breadcrumb();
		}
		?>
		<?php
		/**
		 * DO_ACTION: yith_wcwl_wishlist_before_wishlist_content
		 *
		 * Allows to render some content or fire some action before the wishlist content.
		 *
		 * @param array $var Array of attributes that needs to be sent to sub-template
		 */
		//do_action('yith_wcwl_wishlist_before_wishlist_content', $var);
		?>

		<?php
		/**
		 * DO_ACTION: yith_wcwl_wishlist_before_wishlist_content
		 *
		 * Allows to render some content or fire some action in the wishlist content.
		 *
		 * @param array $var Array of attributes that needs to be sent to sub-template
		 */
		do_action('yith_wcwl_wishlist_main_wishlist_content', $var);
		?>

		<?php
		/**
		 * DO_ACTION: yith_wcwl_wishlist_after_wishlist_content
		 *
		 * Allows to render some content or fire some action after the wishlist content.
		 *
		 * @param array $var Array of attributes that needs to be sent to sub-template
		 */
		//do_action('yith_wcwl_wishlist_after_wishlist_content', $var);
		?>
	</div>
</section>