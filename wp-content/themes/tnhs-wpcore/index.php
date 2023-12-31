<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tnhs-wpcore
 */

get_header(); ?>
<main id="primary" class="site-main">
	<?php
	get_template_part("template-parts/home/section1");
	get_template_part("template-parts/home/section2");
	?>
</main>
<script src="<?=THEME_ASSETS?>/scripts/home.min.js" defer></script>
<?php get_footer();
