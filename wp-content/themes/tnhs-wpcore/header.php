<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tnhs-wpcore
 */

$_siteInfo = array(
    'type' => 'website', 
    'title' => get_bloginfo('name'),
    'url' => home_url(), 
    'image' => SCREEN_SHOT,
    'description' => get_bloginfo('description'), 
    'author' => 'tnhs', 
);

if (is_tax() || is_category() || is_tag()) {
    if (!is_category())
        $_siteInfo['url'] = get_term_link(get_query_var('term'), get_query_var('taxonomy'));
    else
        $_siteInfo['url'] = get_category_link(get_query_var('cat'));

    $_siteInfo['title'] = single_term_title('', false) . ' | ' . get_bloginfo('name');
    $_siteInfo['description'] = term_description() ? term_description() : $_siteInfo['description'];
    $_siteInfo['type'] = 'article';
}

if (is_search()) {
    $_siteInfo['title'] = 'Search: ' . esc_html(get_query_var('s')) . ' | ' . get_bloginfo('name');
    $_siteInfo['description'] = 'Search result for "' . esc_html(get_query_var('s')) . '" from ' . get_bloginfo('name');
}

if (is_author()) {
    $authorID = get_query_var('author');
    $authorData = get_userdata($authorID);
    $_siteInfo['title'] = $authorData->display_name . ' @ ' . get_bloginfo('name');
    $_siteInfo['description'] = $authorData->description ? $authorData->description : $_siteInfo['description'];
}

if (is_single() || is_page()) {
    $imageSource = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $postDescription = $post->post_excerpt ? $post->post_excerpt : wp_trim_words($post->post_content);
    $_siteInfo['title'] = $post->post_title;
    $_siteInfo['description'] = $postDescription ? strip_tags($postDescription) : $_siteInfo['description'];
    $_siteInfo['image'] = $imageSource ? $imageSource[0] : $_siteInfo['image'];
    $_siteInfo['url'] = get_permalink($post->ID);
    $_siteInfo['type'] = 'article';
    $_siteInfo['author'] = get_the_author_meta('display_name', $post->post_author);
}

if (is_paged()) {
    $_siteInfo['title'] .= ' | ' . __('Page', TEXTDOMAIN) . ' ' . get_query_var('paged');
    $_siteInfo['description'] .= ' | ' . __('Page', TEXTDOMAIN) . ' ' . get_query_var('paged');
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo str_replace('"', '', $_siteInfo['author']); ?>" />
    <!-- <meta property="og:type" content='<?php echo $_siteInfo['type']; ?>' /> -->
    <!-- <meta property="og:title" content="<?php echo str_replace('"', '', $_siteInfo['title']); ?>" /> -->
    <!-- <meta property="og:url" content="<?php echo $_siteInfo['url']; ?>" /> -->
    <meta property="og:image" content="<?php echo $_siteInfo['image']; ?>" />
    <meta name="description" content="<?php echo str_replace('"', '', $_siteInfo['description']); ?>" />
    <meta property="og:description" content="<?php echo str_replace('"', '', $_siteInfo['description']); ?>" />
    <meta HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link type="image/x-icon" rel="shortcut icon" href="<?php echo FAVICON; ?>">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PN1JVW9WTE"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-PN1JVW9WTE');
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <?php get_template_part('template-parts/header/header-main'); ?>