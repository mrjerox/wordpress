<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tnhs-wpcore
 */

?>
	<?php 
		get_template_part('template-parts/components/box-cart');
		get_template_part('template-parts/footer/footer-main');
	?>
</div>

<?php wp_footer(); ?>

</body>
</html>
