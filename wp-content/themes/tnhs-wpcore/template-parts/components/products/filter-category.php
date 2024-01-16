<section class="box-sheet-category" id="home-category">
	<div class="overlay"></div>
	<div class="sheet-category">
		<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0"><?php _e('Danh mục', TEXTDOMAIN); ?></h3>
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
				$child_categories = get_categories(array(
					'taxonomy' => 'product_cat',
					'hide_empty' => false,
					'parent' => $category->term_id,
					'meta_query' => array(
						array(
							'key' => 'product_cat_ignore',
							'value' => true,
							'compare' => '!=',
						)
					),
				));
			?>
				<li class="<?=$child_categories ? 'has-children' : NULL?>">
					<a href="<?= get_term_link($category->term_id) ?>"><?= $category->name ?></a>
					<?php if ($child_categories) { ?>
						<span class="btn-dropdown"><i class="fa-solid fa-angle-down"></i></span>
						<ul class="sub-menu">
							<?php foreach ($child_categories as $child_category) { ?>
								<li>
									<a href="<?= get_term_link($child_category->term_id) ?>"><?= $child_category->name ?></a>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</li>
			<?php } ?>
		</ul>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const btnDropdown = document.querySelectorAll('.btn-dropdown')
		btnDropdown.forEach((btn) => {
			btn.addEventListener('click', (e) => {
				e.preventDefault()
				let target = e.currentTarget
				let subMenu = target.nextElementSibling
				
				target.classList.toggle('active')
				subMenu.classList.toggle('active')
			})
		})
	})
</script>