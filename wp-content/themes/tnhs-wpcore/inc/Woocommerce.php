<?php
// Remove Woo css
add_filter("woocommerce_enqueue_styles", "__return_empty_array");

// Remove Woo block
function deregister_woocommerce_block_styles()
{
	wp_deregister_style("wc-blocks-style");
	wp_dequeue_style("wc-blocks-style");
}
add_action("enqueue_block_assets", "deregister_woocommerce_block_styles");
