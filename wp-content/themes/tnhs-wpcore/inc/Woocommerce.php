<?php

class Core_Woocommerce
{
	public static function init()
	{
		// Remove Woo block
		add_action("enqueue_block_assets", array("Core_Woocommerce", "deregister_woocommerce_block_styles"));

		// Remove Woo css
		add_filter("woocommerce_enqueue_styles", "__return_empty_array");
		wp_dequeue_style('woocommerce-inline');

		add_action('after_setup_theme', array("Core_Woocommerce", "core_init"));

		// YITH
		add_filter('yith_wcwl_main_style_deps', "__return_empty_array");

		// Ajax handle
		add_action("wp_ajax_test_fetch", array("Core_Woocommerce", "test_fetch"));
		add_action("wp_ajax_nopriv_test_fetch", array("Core_Woocommerce", "test_fetch"));

		add_action("wp_ajax_woocommerce_ajax_add_to_cart", array("Core_Woocommerce", "woocommerce_ajax_add_to_cart"));
		add_action("wp_ajax_nopriv_woocommerce_ajax_add_to_cart", array("Core_Woocommerce", "woocommerce_ajax_add_to_cart"));

		add_action("wp_ajax_ajax_login", array("Core_Woocommerce", "ajax_login"));
		add_action("wp_ajax_nopriv_ajax_login", array("Core_Woocommerce", "ajax_login"));

		add_action("wp_ajax_ajax_register_customer", array("Core_Woocommerce", "ajax_register_customer"));
		add_action("wp_ajax_nopriv_ajax_register_customer", array("Core_Woocommerce", "ajax_register_customer"));
	}
	/**
	 * Init
	 */
	public static function core_init()
	{
		remove_action('wp_head', 'wc_gallery_noscript');
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

	public static function deregister_woocommerce_block_styles()
	{
		wp_deregister_style("wc-blocks-style");
		wp_dequeue_style("wc-blocks-style");
	}

	// Add to cart
	public static function woocommerce_ajax_add_to_cart()
	{
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'add_to_cart')) {
			wp_send_json_error(__('Not valid', 'core'));
			exit;
		}

		$product_id = absint($_POST['product_id']);
		$quantity = 1;
		$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
		$product_status = get_post_status($product_id);
		$in_cart = WC()->cart->find_product_in_cart($product_id);

		if (in_array($product_id, array_column(WC()->cart->get_cart(), 'product_id'))) {
			wp_send_json_success(__("Product in cart", 'core'));
		}

		if ($passed_validation && 'publish' === $product_status) {
			WC()->cart->add_to_cart($product_id, $quantity);
			wp_send_json_success(__("Done", 'core'));
		}
		wp_send_json_error(__("Failed", "core"));
	}

	// Login 
	public static function ajax_login()
	{
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'customer_login')) {
			wp_send_json_error(__('Not valid', 'core'));
			exit;
		}

		$username = $_POST['username'];
		$password = $_POST['password'];

		$user = wp_authenticate($username, $password);

		if (is_wp_error($user)) {
			wp_send_json_error(__('Email hoặc mật khẩu không chính xác.', 'core'));
			exit;
		}

		wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID);
		wp_send_json_success(__('Đăng nhập thành công.', 'core'));
	}

	// Register
	public static function ajax_register_customer()
	{
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'customer_register')) {
			wp_send_json_error(__('Not valid', 'core'));
			exit;
		}

		$email = $_POST['register-email'];
		$password = $_POST['register-pass'];
		$fullname = $_POST['register-name'];

		if (email_exists($email)) {
			wp_send_json_error(__('Email đã được sử dụng.', 'core'));
			exit;
		}

		$user_data = array(
			'user_login' => $email,
			'user_email' => $email,
			'user_pass' => $password,
			'first_name' => $fullname,
		);

		$user_id = wp_insert_user($user_data);

		if (is_wp_error($user_id)) {
			wp_send_json_error(__('Đăng ký không thành công, xin vui lòng thử lại.', 'core'));
			exit;
		} else {
			update_user_meta($user_id, 'billing_first_name', $fullname);
			update_user_meta($user_id, 'billing_last_name', ' ');
			update_user_meta($user_id, 'billing_email', $email);
		}
	}

	public static function test_fetch()
	{
		$data = "Clearr";
		$abc = $_POST['nonce'];
		wp_send_json_success($abc);
	}
}

Core_Woocommerce::init();
