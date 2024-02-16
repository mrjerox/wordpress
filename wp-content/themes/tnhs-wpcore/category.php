<?php 
    get_header(); 
    $obj = get_queried_object();
    $term_id = $obj->term_id;
    $page_name = $obj->name;    
?>
<section class="taxonomy-category py-12">
    <div class="container lg:max-w-screen-lg">
        <div class="box-head mb-3">
            <h1 class="title text-4xl font-bold text-dark"><?= $page_name ?></h1>
        </div>
        <div class="breadcrumb mb-6 text-xs font-medium uppercase">
            <ol class="flex items-center flex-wrap">
                <li><a href="<?= get_home_url() ?>" class="text-xs font-medium uppercase text-neutral-400"><?php _e('Trang chủ', TEXTDOMAIN); ?></a><span> /&nbsp;</span></li>
                <li><span class="text-xs font-medium uppercase"><?= $page_name ?></span></li>
            </ol>
        </div>
        <div class="blog-list grid gap-8 lg:grid-cols-2">
            <?php
                $post_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'posts_per_page' => 6,
					'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    'cat' => array($term_id),
                );
                $post_query = new WP_Query($post_args);
                if ($post_query->have_posts()) {
                    while($post_query->have_posts()) {
                        $post_query->the_post();
                        get_template_part('template-parts/components/blogs/blog-item');
            ?>         
            <?php }}; wp_reset_postdata(); ?>  
        </div>
    </div>
</section>
<?php get_footer();
