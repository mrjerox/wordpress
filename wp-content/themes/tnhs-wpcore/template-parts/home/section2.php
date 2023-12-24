<section class="box-home-other pb-12">
	<div class="container lg:max-w-screen-lg">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
			<?php
			$categories = get_categories(array(
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
				'parent' => 0,
				'meta_query' => array(
					array(
						'key' => 'product_cat_ignore',
						'value' => true,
						'compare' => '=',
					)
				),
			));

			foreach ($categories as $category) {
			?>
				<div class="featured-category">
					<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0"><?=$category->name?></h3>
					<div class="other-list">
						<?php
							$args = array(
								'post_type' => 'product',
								'posts_per_page' => 5,
								'post_status' => 'publish',
								'order' => 'DESC',
								'tax_query' => array(
									array(
										'taxonomy' => 'product_cat',
										'field' => 'term_id',
										'terms' => array($category->term_id)
									)
								),
							);

							$sheets = new WP_Query($args);
							while ($sheets->have_posts()) { $sheets->the_post() 
						?>
							<?php get_template_part('template-parts/components/products/list-item');?>
						<?php } wp_reset_postdata();?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>