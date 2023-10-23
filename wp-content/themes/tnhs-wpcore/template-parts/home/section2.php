<section class="box-home-other pb-12">
	<div class="container lg:max-w-screen-lg">
		<div class="grid grid-cols-3 gap-12">
			<div class="best-selling">
				<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0">Best Selling</h3>
				<div class="other-list">
					<?php get_template_part('template-parts/products/list-item')?>
					<?php get_template_part('template-parts/products/list-item')?>
					<?php get_template_part('template-parts/products/list-item')?>
				</div>
			</div>
			<div class="trending">
				<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0">Trending</h3>
				<div class="other-list">
					<?php get_template_part('template-parts/products/list-item')?>
					<?php get_template_part('template-parts/products/list-item')?>
					<?php get_template_part('template-parts/products/list-item')?>
				</div>
			</div>
			<div class="recently">
				<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0">Recently Viewed</h3>
				<div class="other-list">
					<?php get_template_part('template-parts/products/list-item')?>
					<?php get_template_part('template-parts/products/list-item')?>
					<?php get_template_part('template-parts/products/list-item')?>
				</div>
			</div>
		</div>
	</div>
</section>