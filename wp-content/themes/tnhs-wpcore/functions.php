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
    define("SCREEN_SHOT", THEME_URI . "/screenshot.png");
}

/**
 * Include
 */
require_once get_template_directory() . "/inc/Function.php";
require_once get_template_directory() . "/inc/Menu.php";
require_once get_template_directory() . "/inc/Redirect.php";
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
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Core();
        }
        return self::$_instance;
    }

    public function core_setup()
    {
        // Language
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

        // Woocommerce
        add_theme_support('woocommerce');

        // Soil plugin
        $soil = array(
            "clean-up",
            "disable-rest-api",
            "disable-asset-versioning",
            "disable-trackbacks",
            'google-analytics' => 'G-PN1JVW9WTE',
            "js-to-footer",
            "nav-walker",
            "nice-search",
            "relative-urls",
        );

        if (current_user_can("administrator")) {
            unset($soil[1]);
        }
        add_theme_support("soil", $soil);
        
        // Change global query
        add_action( 'pre_get_posts', array($this, 'modify_global_query'));

        // Remove RSS
        add_action('do_feed', array($this, "disable_rss_feed"), 1);
        add_action('do_feed_rdf', array($this, "disable_rss_feed"), 1);
        add_action('do_feed_rss', array($this, "disable_rss_feed"), 1);
        add_action('do_feed_rss2', array($this, "disable_rss_feed"), 1);
        add_action('do_feed_atom', array($this, "disable_rss_feed"), 1);
        add_action('do_feed_rss2_comments', array($this, "disable_rss_feed"), 1);
        add_action('do_feed_atom_comments', array($this, "disable_rss_feed"), 1);
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
            "swiper",
            "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        );
        wp_enqueue_style(
            "fancy-box",
            "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
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
            array(),
            false,
        );
        wp_enqueue_script(
            "swiper",
            "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
            array(),
            false,
        );
        wp_enqueue_script(
            "sweet-alert",
            "https://cdn.jsdelivr.net/npm/sweetalert2@11",
            array(),
            false,
        );
        wp_enqueue_script(
            "fancy-box",
            "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js",
            array(),
            false,
        );
        wp_enqueue_script(
            "form-validation",
            THEME_ASSETS . '/scripts/form-validation.min.js',
            array(),
            false,
        );
        // Localize script
        $wp_script_data = array(
            'AJAX_URL' => ADMIN_AJAX_URL,
            'ADD_TO_WISHLIST' => __('Đã thêm vào wishlist', TEXTDOMAIN),
            'ADD_TO_WISHLIST_EXIST' => __('Đã có trong wishlist', TEXTDOMAIN),
            'ADD_TO_CART' => __('Đã thêm vào giỏ hàng', TEXTDOMAIN),
            'ADD_TO_CART_FAILED' => __('Thêm vào giỏ hàng không thành công', TEXTDOMAIN),
            'ACCOUNT_URL' => get_permalink(wc_get_page_id('myaccount')),
            'CART_URL' => wc_get_cart_url(),
        );
        wp_register_script('wpcore-js', THEME_ASSETS . "/scripts/scripts.min.js");
        wp_localize_script('wpcore-js', 'obj', $wp_script_data);
        wp_enqueue_script(
            "wpcore-js",
            THEME_ASSETS . "/scripts/scripts.min.js",
            array(),
            VERSION,
            array(
                'strategy' => 'defer'
            ),
        );
        if (!current_user_can("administrator")) {
            wp_deregister_script('jquery');
        }
    }

    /**
     * Disable RSS
    */
    public function disable_rss_feed() {
        wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ));
    }

    /**
     * Edit global query
    */
    public function modify_global_query( $query ) {
        if (!is_admin() && $query->is_tax("product_cat") || is_shop()){
             $query->set('posts_per_page', 12);
        }
    }
}

Core::instance();