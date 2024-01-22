<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package tnhs-wpcore
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		get_template_part("template-parts/home/section1");
		get_template_part("template-parts/home/section2");
		?>
	</main>
	<script src="<?=THEME_ASSETS?>/scripts/category.min.js" defer></script>
<?php
get_sidebar();
get_footer();
