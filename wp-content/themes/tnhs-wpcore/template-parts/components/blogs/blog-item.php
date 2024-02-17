<?php
    $title = get_the_title();
    $permalink = get_the_permalink();
    $excerpt = get_the_excerpt();
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author();
    $avatar = get_avatar_url($author_id);
    $categories = get_the_category();
?>

<article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-between items-center mb-5 text-gray-500">
        <?php foreach ($categories as $category) { ?>
            <a href="<?=get_term_link($category->term_id)?>" class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 hover:bg-gray-900 hover:text-gray-100"><?=$category->name?></a>
        <?php } ?>
        <span class="text-sm"><?=get_the_date('d/m/Y')?></span>
    </div>
    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        <a href="<?=$permalink?>"><?=$title?></a>
    </h2>
    <p class="mb-5 font-light text-gray-500 dark:text-gray-400"><?=$excerpt?></p>
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img class="w-7 h-7 rounded-full" src="<?=$avatar?>" alt="<?=$author_name?> avatar" />
            <span class="font-medium dark:text-white"><?=$author_name?></span>
        </div>
        <a href="<?=$permalink?>" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
            <?php _e('Xem thêm', TEXTDOMAIN);?>
            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</article>