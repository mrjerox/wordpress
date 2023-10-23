<section class="box-home-sheets py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<h2 class="title text-4xl font-semibold text-dark">Sheet Music</h2>
		</div>
		<div class="breadcrumb mb-6">
			<a href="#">Home</a> / <span>Sheet Music</span>
		</div>
		<div class="sheet-list grid grid-cols-4 gap-8">
			<?php get_template_part('template-parts/products/sheet-item');?>
			<?php get_template_part('template-parts/products/sheet-item');?>
			<?php get_template_part('template-parts/products/sheet-item');?>
			<?php get_template_part('template-parts/products/sheet-item');?>
		</div>
	</div>
</section>
