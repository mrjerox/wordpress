<section class="box-sheet-category" id="home-category">
	<div class="overlay"></div>
	<div class="sheet-category">
		<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0"><?php _e('Danh mục', TEXTDOMAIN);?></h3>
		<ul>
			<?php
				$categories = get_categories(array(
					'taxonomy' => 'product_cat',
					'hide_empty' => false,
					'parent' => 0,
					'meta_query' => array(
						array(
							'key' => 'product_cat_ignore',
							'value' => true,
							'compare' => '!=',
						)
					),
				));

				foreach ($categories as $category) {
			?>
			<li><a href="<?=get_term_link($category->term_id)?>"><?=$category->name?></a></li>
			<?php } ?>
		</ul>
	</div>
</section>