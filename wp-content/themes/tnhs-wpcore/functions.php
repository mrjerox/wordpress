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
}

/**
 * Include
 */
require_once get_template_directory() . '/inc/constant.php';
require_once get_template_directory() . '/inc/customizer.php';

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
        load_theme_textdomain('tnhs-wpcore', get_template_directory() . '/languages');
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
        add_theme_support('soil', [
            'clean-up',
            'disable-rest-api',
            'disable-asset-versioning',
            'disable-trackbacks',
            'google-analytics' => 'UA-XXXXX-Y',
            'js-to-footer',
            'nav-walker',
            'nice-search',
            'relative-urls'
        ]);

        register_nav_menus(
            array(
                'main' => esc_html__('Primary', TEXTDOMAIN),
            )
        );
    }

    /**
     * Enqueue scripts and styles.
     */
    function wpcore_enqueue()
    {
        wp_enqueue_style('wpcore-style', get_stylesheet_uri(), array(), VERSION);
        wp_enqueue_script('tnhs-wpcore-navigation', get_template_directory_uri() . '/js/scripts.js', array(), VERSION, true);
    }
}

Core::instance();
