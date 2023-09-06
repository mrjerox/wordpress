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

get_header();
?>
<main id="primary" class="site-main">
	<section class="box-home-sheets py-12">
		<div class="container lg:max-w-screen-lg">
			<div class="box-head mb-3">
				<h2 class="title text-4xl font-semibold text-dark">Sheet Music</h2>
			</div>
			<div class="breadcrumb mb-6">
				<a href="#">Home</a> / <span>Sheet Music</span>
			</div>
			<div class="sheet-list grid grid-cols-4 gap-8">
				<div class="sheet-item">
					<a href="#" class="sheet-img block">
						<img src="https://picsum.photos/500" class="aspect-square" alt="Sheet">
					</a>
					<div class="sheet-body mt-3 text-center">
						<a href="#" class="sheet-title block text-sm text-center">BLACKPINK - Pink Venom</a>
						<span class="price block center font-semibold text-sm">200.000₫</span>
					</div>
				</div>
				<div class="sheet-item">
					<a href="#" class="sheet-img block">
						<img src="https://picsum.photos/500" class="aspect-square" alt="Sheet">
					</a>
					<div class="sheet-body mt-3 text-center">
						<a href="#" class="sheet-title block text-sm text-center">BLACKPINK - Pink Venom</a>
						<span class="price block center font-semibold text-sm">200.000₫</span>
					</div>
				</div>
				<div class="sheet-item">
					<a href="#" class="sheet-img block">
						<img src="https://picsum.photos/500" class="aspect-square" alt="Sheet">
					</a>
					<div class="sheet-body mt-3 text-center">
						<a href="#" class="sheet-title block text-sm text-center">BLACKPINK - Pink Venom</a>
						<span class="price block center font-semibold text-sm">200.000₫</span>
					</div>
				</div>
				<div class="sheet-item">
					<a href="#" class="sheet-img block">
						<img src="https://picsum.photos/500" class="aspect-square" alt="Sheet">
					</a>
					<div class="sheet-body mt-3 text-center">
						<a href="#" class="sheet-title block text-sm text-center">BLACKPINK - Pink Venom</a>
						<span class="price block center font-semibold text-sm">200.000₫</span>
					</div>
				</div>
				<div class="sheet-item">
					<a href="#" class="sheet-img block">
						<img src="https://picsum.photos/500" class="aspect-square" alt="Sheet">
					</a>
					<div class="sheet-body mt-3 text-center">
						<a href="#" class="sheet-title block text-sm text-center">BLACKPINK - Pink Venom</a>
						<span class="price block center font-semibold text-sm">200.000₫</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="box-home-other pb-12">
		<div class="container lg:max-w-screen-lg">
			<div class="grid grid-cols-3 gap-12">
				<div class="best-selling">
					<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0">Best Selling</h3>
					<div class="other-list">
						<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
							<a href="#" class="block other-img max-w-[65px]">
								<img src="http://picsum.photos/500" alt="Lewlew" class="aspect-square">
							</a>
							<div class="item-body pl-4">
								<a href="#" class="item-title text-sm">BTS - The Truth Untold</a>
								<span class="price block center font-semibold text-sm">200.000₫</span>
							</div>
						</div>
						<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
							<a href="#" class="block other-img max-w-[65px]">
								<img src="http://picsum.photos/500" alt="Lewlew" class="aspect-square">
							</a>
							<div class="item-body pl-4">
								<a href="#" class="item-title text-sm">BTS - The Truth Untold</a>
								<span class="price block center font-semibold text-sm">200.000₫</span>
							</div>
						</div>
					</div>
				</div>
				<div class="best-selling">
					<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0">Latest</h3>
					<div class="other-list">
						<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
							<a href="#" class="block other-img max-w-[65px]">
								<img src="http://picsum.photos/500" alt="Lewlew" class="aspect-square">
							</a>
							<div class="item-body pl-4">
								<a href="#" class="item-title text-sm">BTS - The Truth Untold</a>
								<span class="price block center font-semibold text-sm">200.000₫</span>
							</div>
						</div>
						<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
							<a href="#" class="block other-img max-w-[65px]">
								<img src="http://picsum.photos/500" alt="Lewlew" class="aspect-square">
							</a>
							<div class="item-body pl-4">
								<a href="#" class="item-title text-sm">BTS - The Truth Untold</a>
								<span class="price block center font-semibold text-sm">200.000₫</span>
							</div>
						</div>
					</div>
				</div>
				<div class="best-selling">
					<h3 class="title relative text-lg font-semibold mb-5 pb-2 before:content-[''] before:w-[50px] before:h-[3px] before:bg-gray-500 before:absolute before:bottom-0 before:left-0">Recently Viewed</h3>
					<div class="other-list">
						<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
							<a href="#" class="block other-img max-w-[65px]">
								<img src="http://picsum.photos/500" alt="Lewlew" class="aspect-square">
							</a>
							<div class="item-body pl-4">
								<a href="#" class="item-title text-sm">BTS - The Truth Untold</a>
								<span class="price block center font-semibold text-sm">200.000₫</span>
							</div>
						</div>
						<div class="item flex items-center mb-3 pb-3 border-b border-slate-300">
							<a href="#" class="block other-img max-w-[65px]">
								<img src="http://picsum.photos/500" alt="Lewlew" class="aspect-square">
							</a>
							<div class="item-body pl-4">
								<a href="#" class="item-title text-sm">BTS - The Truth Untold</a>
								<span class="price block center font-semibold text-sm">200.000₫</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
