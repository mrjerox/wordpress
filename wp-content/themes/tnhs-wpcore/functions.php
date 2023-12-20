<?php

/**
 * tnhs-wpcore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tnhs-wpcore
 */

/**
 * Constant
 */
if (!defined("VERSION")) {
    // Replace the version number of the theme on each release.
    define("VERSION", "1.0.0");
    define("TEXTDOMAIN", "core");
    define("HOME_URL", get_home_url());
    define("THEME_DIR", get_template_directory());
    define("THEME_URI", get_template_directory_uri());
    define("THEME_ASSETS", THEME_URI . "/assets");
    define("ADMIN_AJAX_URL", admin_url("admin-ajax.php"));
    define("FAVICON", THEME_ASSETS . "/images/favicon.png");
    define("SCREEN_SHOT", THEME_URI . "/screenshot.jpg");
}

/**
 * Include
 */
require_once get_template_directory() . "/inc/Function.php";
require_once get_template_directory() . "/inc/Woocommerce.php";

/**
 * Setup
 */
class Core
{
    private static $_instance;

    public function __construct()
    {
        add_action("after_setup_theme", array($this, "core_setup"));
        add_action("wp_enqueue_scripts", array($this, "core_enqueue"));
        add_action("template_redirect", array($this, "remove_wc_assets"));
        add_filter("woocommerce_enqueue_styles", array($this, "woocommerce_enqueue_styles"));
        add_action('init', array($this, "core_init"));
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Core();
        }
        return self::$_instance;
    }

    public static function is_wc_page()
    {
        return class_exists('WooCommerce') && (is_woocommerce());
    }

    public function core_setup()
    {
        load_theme_textdomain(
            TEXTDOMAIN,
            get_template_directory() . "/languages"
        );
        add_theme_support("title-tag");
        add_theme_support("post-thumbnails");
        add_theme_support("html5", [
            "search-form",
            "comment-form",
            "comment-list",
            "gallery",
            "caption",
            "style",
            "script",
        ]);
        add_theme_support('woocommerce');
        if (!current_user_can("administrator")) {
            add_theme_support("soil", [
                "clean-up",
                "disable-rest-api",
                "disable-asset-versioning",
                "disable-trackbacks",
                // 'google-analytics' => 'UA-XXXXX-Y',
                "js-to-footer",
                "nav-walker",
                "nice-search",
                "relative-urls",
            ]);
        }
    }

    /**
     * Enqueue scripts and styles.
     */
    public function core_enqueue()
    {
        // CSS
        wp_enqueue_style(
            "font-awesome",
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        );
        wp_enqueue_style(
            "wpcore-style",
            get_template_directory_uri() . "/style.css",
            VERSION
        );
        // JS
        wp_enqueue_script(
            "lazy-loading",
            "https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.5/dist/lazyload.min.js",
            false,
            true
        );
        wp_enqueue_script(
            "wpcore-js",
            THEME_ASSETS . "/js/scripts.js",
            VERSION,
            true
        );
        // Remove woocomerce style
        if (self::is_wc_page()) {
            wp_dequeue_style('woocommerce-inline');
        }
        // Localize script
        $wp_script_data = array(
            'AJAX_URL' => ADMIN_AJAX_URL,
        );
        wp_localize_script('scripts', 'obj', $wp_script_data);
    }

    /**
     * Init
     */
    public function core_init()
    {
        remove_action('wp_head', 'wc_gallery_noscript');
    }

    /*
    * Woocomerce
    */
    public function woocommerce_enqueue_styles($enqueue_styles)
    {
        return self::is_wc_page() ? $enqueue_styles : array();
    }

    public function remove_wc_assets()
    {
        // if this is a WC page, abort.
        if (self::is_wc_page()) {
            return;
        }
        // remove WC generator tag
        remove_filter('get_the_generator_html', 'wc_generator_tag', 10, 2);
        remove_filter('get_the_generator_xhtml', 'wc_generator_tag', 10, 2);
        // unload WC scripts
        remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
        remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
        remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
        // remove "Show the gallery if JS is disabled"
        remove_action('wp_head', 'wc_gallery_noscript');
        // remove WC body class
        remove_filter('body_class', 'wc_body_class');
    }
}

Core::instance();