<?php
    $general_logo = get_field('general_logo', 'option') ? get_field('general_logo', 'option') : THEME_ASSETS . '/images/logo.png';
?>

<div class="hidden px-2 py-3 block p-2 text-sm absolute relative top-[0] right-[0] text-xs"></div>
<header class="site-header shadow-md shadow-gray-100">
    <div class="container max-w-full">
        <div class="flex justify-between items-center py-4">
            <div id="btn-search" class="btn-search cursor-pointer inline-flex items-center justify-center w-7 p-3">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <nav class="main-menu hidden lg:block --menu-left text-sm basis-5/12">
                <?php
                    wp_nav_menu(array(
                        'menu' => 'Main menu - Left', 
                        'container'            => false,
                        'menu_class'    => "flex justify-start uppercase",
                        'theme_location'    => "main-menu-left",
                    ));
                ?>
            </nav>
            <div class="box-logo basis-2/12">
                <a href="<?=get_home_url()?>" class="block max-w-full mx-auto">
                    <img src="<?=$general_logo?>" class="mx-auto max-w-[270px]" alt="nguoinghienchoidan">
                </a>
            </div>
            <nav class="main-menu hidden lg:block --menu-right text-sm basis-5/12">
                <?php
                    wp_nav_menu(array(
                        'menu' => 'Main menu - Right', 
                        'container'            => false,
                        'menu_class'    => "flex justify-end uppercase",
                        'theme_location'    => "main-menu-right",
                    ));
                ?>
            </nav>
            <div class="box-mobile-menu" id="box-mobile-menu">
                <div class="overlay"></div>
                <nav id="mobile-menu" class="mobile-menu flex flex-col justify-center items-center lg:hidden shadow-md shadow-gray-100">
                    <a href="#" class="block max-w-full mx-auto">
                        <img src="<?=$general_logo?>" class="mx-auto max-w-[200px]" alt="nguoinghienchoidan">
                    </a>
                    <?php
                        wp_nav_menu(array(
                            'menu' => 'Main menu mobile', 
                            'container'            => false,
                            'menu_class'    => "",
                            'theme_location'    => "main-menu-mobile",
                        ));
                    ?>
                </nav>
            </div>
            <div class="btn-menu cursor-pointer lg:hidden" id="btn-menu">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="box-search" id="search">
                <div class="overlay"></div>
                <form action="<?=get_home_url()?>">
                    <input type="text" name="s" placeholder="<?php _e('Search...', 'core');?>">
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>