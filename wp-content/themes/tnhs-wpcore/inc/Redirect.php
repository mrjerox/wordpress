<?php
add_action('template_redirect', 'redirect_url');
function redirect_url()
{
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (preg_match('/\s?[^a-z0-9\_]script[^a-z0-9\_]/i', $actual_link)) {
        wp_safe_redirect(get_home_url() . '/404');
    }

    // if (preg_match('/\s?[^a-z0-9\_]shop[^a-z0-9\_]/i', $actual_link)) {
    //     wp_safe_redirect(get_home_url() . '/');
    // }
}
?>