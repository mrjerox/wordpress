<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tnhs-wpcore
 */

get_header();
$page_name = get_the_title();
$page_id = get_the_ID();
$author_id = get_the_author_meta('ID');
$author_name = get_the_author();
$avatar = get_avatar_url($author_id);
?>
<section class="taxonomy-category py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<div class="title text-4xl font-bold text-dark"><?php _e('Blogs', TEXTDOMAIN); ?></div>
		</div>
		<?php
		if (function_exists('custom_breadcrumb')) {
			echo custom_breadcrumb();
		}
		?>
		<div class="blog-detail">
			<h1 class="text-2xl font-bold relative pt-6"><?= $page_name ?></h1>
			<div class="flex items-center mt-4 mb-8">
				<div class="flex items-center space-x-4 mr-6">
					<img class="w-7 h-7 rounded-full" src="<?= $avatar ?>" alt="<?= $author_name ?> avatar" />
					<span class="font-medium dark:text-white"><?= $author_name ?></span>
				</div>
				<span class="text-sm"><?=get_the_date('d/m/Y')?></span>
			</div>
			<div class="blog-content">
				<?php the_content() ?>
			</div>
		</div>
		<?php
			$post_tags = get_the_tags();
			if ($post_tags) {
		?>
		<div class="tags flex align-center flex-wrap mt-6">
			<span><?php _e('Từ khóa: ', TEXTDOMAIN);?></span>
			<ul class="flex align-center flex-wrap">
				<?php foreach ($post_tags as $tag) { ?>
					<li><a class="ml-2 mb-2 text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 rounded-full bg-white text-gray-700 border" href="<?=get_term_link($tag->term_id);?>"><?=$tag->name?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php }?>
		<div class="blog-list grid gap-8 lg:grid-cols-2 mt-[4rem]">
			<?php
			$post_args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => 'DESC',
				'post__not_in' => array($page_id),
				'posts_per_page' => 6,
			);
			$post_query = new WP_Query($post_args);
			if ($post_query->have_posts()) {
				while ($post_query->have_posts()) {
					$post_query->the_post();
					get_template_part('template-parts/components/blogs/blog-item');
			?>
			<?php }
			};
			wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php
get_sidebar();
get_footer();
