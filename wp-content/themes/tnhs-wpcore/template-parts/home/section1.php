<section class="box-home-sheets py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<h2 class="title text-4xl font-bold text-dark">Sheet Music</h2>
		</div>
		<div class="breadcrumb mb-6 text-xs font-medium uppercase">
			<a href="<?=get_home_url()?>" class="text-xs font-medium uppercase text-neutral-400"><?php _e('Trang chủ', TEXTDOMAIN);?></a> / <span class="text-xs font-medium uppercase">Sheet Music</span>
		</div>
		<div class="filter flex items-center justify-between mb-6">
			<div class="filter-category cursor-pointer" id="btn-filter">
				<i class="fa-solid fa-bars"></i>
				<span><?php _e('Bộ lọc', TEXTDOMAIN);?></span>
			</div>
			<div class="filter-order text-sm">
				<select class="p-1">
					<option value=""><?php _e('Chọn...', TEXTDOMAIN);?></option>
					<option value=""><?php _e('Lọc theo tên: A -> Z', TEXTDOMAIN);?></option>
					<option value=""><?php _e('Lọc theo tên: Z -> A', TEXTDOMAIN);?></option>
					<option value=""><?php _e('Lọc theo giá: cao -> thấp', TEXTDOMAIN);?></option>
					<option value=""><?php _e('Lọc theo giá: thấp -> cao', TEXTDOMAIN);?></option>
				</select>
			</div>
		</div>
		<div class="sheet-list grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
			<?php
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 12,
					'post_status' => 'publish',
					'order' => 'DESC',
				);

				$sheets = new WP_Query($args);
				while ($sheets->have_posts()) { $sheets->the_post() 
			?>
				<?php get_template_part('template-parts/components/products/sheet-item');?>
			<?php } wp_reset_postdata();?>
		</div>
	</div>
</section>
<?php get_template_part('template-parts/components/products/filter-category')?>