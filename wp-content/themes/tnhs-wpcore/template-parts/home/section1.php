<section class="box-home-sheets py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="box-head mb-3">
			<h2 class="title text-4xl font-semibold text-dark">Sheet Music</h2>
		</div>
		<div class="breadcrumb mb-6 text-xs font-medium uppercase">
			<a href="#" class="text-xs font-medium uppercase text-neutral-400">Home</a> / <span class="text-xs font-medium uppercase">Sheet Music</span>
		</div>
		<div class="filter flex items-center justify-between mb-6">
			<div class="filter-category cursor-pointer" id="btn-filter">
				<i class="fa-solid fa-bars"></i>
				<span>Filter</span>
			</div>
			<div class="filter-order text-sm">
				<select class="p-1">
					<option value="">Choose...</option>
					<option value="">Soft by name: A -> Z</option>
					<option value="">Soft by name: Z -> A</option>
					<option value="">Soft by price: hight -> low</option>
					<option value="">Soft by price: low -> hight</option>
				</select>
			</div>
		</div>
		<div class="sheet-list grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
			<?php get_template_part('template-parts/components/products/sheet-item');?>
			<?php get_template_part('template-parts/components/products/sheet-item');?>
			<?php get_template_part('template-parts/components/products/sheet-item');?>
			<?php get_template_part('template-parts/components/products/sheet-item');?>
		</div>
	</div>
</section>
<?php get_template_part('template-parts/components/products/filter-category')?>