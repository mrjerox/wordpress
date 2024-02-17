<?php

/**
 * Template Name: FAQ
 */
get_header();
$page_name = get_the_title();
?>
<section class="page-faq py-12">
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
        <div class="faq-list" data-accordion="collapse">
            <?php
                $faq_list = get_field('faq_list');
                foreach ($faq_list as $key => $item) {
            ?>
            <div class="collapse-item">
                <h2 class="collapse-title">
                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right <?=$key===0 ? 'text-gray-900' : 'text-gray-500'?> border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-target="#collapse-body<?=$key?>">
                        <span><?=$item['title']?></span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div class="collapse-body <?=$key!==0 ? 'hidden' : NULL ?>" id="collapse-body<?=$key?>">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <?=$item['content']?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<script defer>
    window.addEventListener('DOMContentLoaded', () => {
        const collapseItem = document.querySelectorAll('.faq-list .collapse-item button');
        collapseItem.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault()
                let target = e.currentTarget
                let body = document.querySelector(target.getAttribute('data-target'))
                console.log(target);
                body.classList.toggle('hidden');
                target.classList.toggle('text-gray-500');
                target.classList.toggle('text-gray-900');
            })
        })
    })
</script>
<?php get_footer();
