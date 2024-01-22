<?php
$obj = get_queried_object();
$term_id = '';
$page_name = 'Sheet Music';

if (is_product_category()) {
	$term_id = $obj->term_id;
	$page_name = $obj->name;
}

if (is_shop()) {
	$page_name = __('Tất cả Sheet Music', TEXTDOMAIN);
}

if (is_search()) {
	$keyword = get_search_query();
	$page_name = __('Tìm kiếm', TEXTDOMAIN) . ' ' . $keyword;
}
?>

<section class="box-home-sheets py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<h2 class="title text-4xl font-bold text-dark"><?= $page_name ?></h2>
		</div>
		<div class="breadcrumb mb-6 text-xs font-medium uppercase">
			<ol class="flex items-center flex-wrap">
				<li><a href="<?= get_home_url() ?>" class="text-xs font-medium uppercase text-neutral-400"><?php _e('Trang chủ', TEXTDOMAIN); ?></a></li>
				&nbsp;/&nbsp;
				<li><span class="text-xs font-medium uppercase"><?= $page_name ?></span></li>
			</ol>
			<p class="mt-4">Trang web đang trong quá trình update hình ảnh, tuy nhiên bạn vẫn có thể mua và tải xuống sheet nhạc</p>
		</div>
		<?php if (is_product_category() || is_shop()  || is_search()) {?>
			<div class="filter flex items-center justify-between mb-6">
			<div class="filter-category cursor-pointer" id="btn-filter">
				<i class="fa-solid fa-bars"></i>
				<span><?php _e('Bộ lọc', TEXTDOMAIN); ?></span>
			</div>
			<div class="filter-order text-sm">
				<select class="p-1" id="select-order">
					<option value=""><?php _e('Chọn...', TEXTDOMAIN); ?></option>
					<option value="az" <?=isset($_GET['order']) && $_GET['order'] === 'az' ? 'selected' : NULL?> ><?php _e('Lọc theo tên: A -> Z', TEXTDOMAIN); ?></option>
					<option value="za" <?=isset($_GET['order']) && $_GET['order'] === 'za' ? 'selected' : NULL?> ><?php _e('Lọc theo tên: Z -> A', TEXTDOMAIN); ?></option>
					<option value="high" <?=isset($_GET['order']) && $_GET['order'] === 'high' ? 'selected' : NULL?> ><?php _e('Lọc theo giá: cao -> thấp', TEXTDOMAIN); ?></option>
					<option value="low" <?=isset($_GET['order']) && $_GET['order'] === 'low' ? 'selected' : NULL?> ><?php _e('Lọc theo giá: thấp -> cao', TEXTDOMAIN); ?></option>
				</select>
			</div>
		</div>
		<?php } ?>
		<div class="sheet">
			<div class="sheet-list grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
				<?php
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 12,
					'post_status' => 'publish',
					'order' => 'DESC',
					'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
				);
				if (is_search()) {
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => 12,
						'post_status' => 'publish',
						'order' => 'DESC',
						's' => $keyword,
						'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
					);
				}

				if (isset($_GET['order'])) {
					switch($_GET['order']) {
						case 'az':
							$args['orderby'] = 'title';
							$args['order'] = 'ASC'; 
							break;
						case 'za':
							$args['orderby'] = 'title';
							$args['order'] = 'DESC'; 
							break;
						case 'high':
							$args['meta_key'] = '_price';
							$args['orderby'] = 'meta_value_num';
							$args['order'] = 'DESC';
							break;
						case 'low':
							$args['meta_key'] = '_price';
							$args['orderby'] = 'meta_value_num';
							$args['order'] = 'ASC';
							break;
						default:
							break;
					}
				}

				if (is_product_category()) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => array($term_id),
						)
					);
				}

				$sheets = new WP_Query($args);
				while ($sheets->have_posts()) {
					$sheets->the_post()
				?>
					<?php get_template_part('template-parts/components/products/sheet-item'); ?>
				<?php }
				wp_reset_postdata(); ?>
			</div>
			<?php if(is_product_category() || is_shop() || is_search()) {wp_paginate_paged($sheets);} ?>
			<?php if (is_home()) { ?>
				<div class="box-button text-center mt-6">
					<a href="<?= wc_get_page_permalink( 'shop' )?>" class="text-sm bg-black hover:bg-dark text-white font-semibold py-2 px-4 focus:outline-none focus:shadow-outline"><?php _e('Xem tất cả', TEXTDOMAIN);?></a>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php get_template_part('template-parts/components/products/filter-category') ?>