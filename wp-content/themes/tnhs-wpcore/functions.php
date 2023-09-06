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
if (!defined('VERSION')) {
    // Replace the version number of the theme on each release.
    define('VERSION', '1.0.0');
    define('TEXTDOMAIN', 'wpcore');
    define('HOME_URL', get_home_url());
    define('THEME_DIR', get_template_directory());
    define('THEME_URI', get_template_directory_uri());
    define('THEME_ASSETS', THEME_URI . '/assets');
    define('ADMIN_AJAX_URL', admin_url('admin-ajax.php'));
    define('FAVICON', THEME_ASSETS . '/images/favicon.png');
    define('SCREEN_SHOT', THEME_URI . '/screenshot.jpg');
}

/**
 * Include
 */
require_once get_template_directory() . '/inc/Function.php';

/**
 * Setup
 */
class Core
{
    private static $_instance;

    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'wpcore_setup'));
        add_action('wp_enqueue_scripts', array($this, 'wpcore_enqueue'));
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Core();
        }
        return self::$_instance;
    }

    public function wpcore_setup()
    {
        load_theme_textdomain(TEXTDOMAIN, get_template_directory() . '/languages');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
        if (!current_user_can('administrator')) {
            add_theme_support('soil', [
                'clean-up',
                'disable-rest-api',
                'disable-asset-versioning',
                'disable-trackbacks',
                // 'google-analytics' => 'UA-XXXXX-Y',
                'js-to-footer',
                'nav-walker',
                'nice-search',
                'relative-urls'
            ]);
        }
    }

    /**
     * Enqueue scripts and styles.
     */
    function wpcore_enqueue()
    {
        // CSS
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
        wp_enqueue_style('wpcore-style', get_template_directory_uri() . '/style.css', VERSION);
        // JS
        wp_enqueue_script('wpcore-js', THEME_ASSETS . '/js/scripts.min.js', VERSION, true);
    }
}

Core::instance();
