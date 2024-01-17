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

		// Remove field
		add_filter('woocommerce_checkout_fields', array("Core_Woocommerce", "remove_woo_checkout_fields"));

		// Rename download navigation table
		add_filter("woocommerce_account_downloads_columns", array("Core_Woocommerce", "rename_my_downloads_navigation_table"));

		// Rename order navigation table
		add_filter("woocommerce_account_orders_columns", array("Core_Woocommerce", "rename_my_orders_navigation_table"));

		// Rename account navigation
		add_filter("woocommerce_account_menu_items", array("Core_Woocommerce", "rename_my_account_navigation"));

		// Account enpoints
		add_filter('woocommerce_account_menu_items', array("Core_Woocommerce", 'remove_my_account_links'));

		// YITH
		add_filter('yith_wcwl_main_style_deps', "__return_empty_array");

		// Ajax handle
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

	// Remove field
	public static function remove_woo_checkout_fields($fields)
	{

		// remove billing fields
		unset($fields['billing']['billing_first_name']);
		unset($fields['billing']['billing_last_name']);
		unset($fields['billing']['billing_company']);
		unset($fields['billing']['billing_address_1']);
		unset($fields['billing']['billing_address_2']);
		unset($fields['billing']['billing_city']);
		unset($fields['billing']['billing_postcode']);
		unset($fields['billing']['billing_country']);
		unset($fields['billing']['billing_state']);
		unset($fields['billing']['billing_phone']);
		unset($fields['billing']['billing_email']);

		// remove shipping fields 
		unset($fields['shipping']['shipping_first_name']);
		unset($fields['shipping']['shipping_last_name']);
		unset($fields['shipping']['shipping_company']);
		unset($fields['shipping']['shipping_address_1']);
		unset($fields['shipping']['shipping_address_2']);
		unset($fields['shipping']['shipping_city']);
		unset($fields['shipping']['shipping_postcode']);
		unset($fields['shipping']['shipping_country']);
		unset($fields['shipping']['shipping_state']);

		// remove order comment fields
		unset($fields['order']['order_comments']);

		return $fields;
	}

	// Rename Orders list table
	public static function rename_my_orders_navigation_table ($columns) {
		$columns = array(
			'order-number'  => __( 'Đơn hàng', TEXTDOMAIN ),
			'order-date'    => __( 'Ngày đặt', TEXTDOMAIN ),
			'order-status'  => __( 'Trạng thái', TEXTDOMAIN ),
			'order-total'   => __( 'Tổng tiền', TEXTDOMAIN ),
			'order-actions' => __( 'Hành động', TEXTDOMAIN ),
		);

		return $columns;
	}

	// Rename Downloads list table
	public static function rename_my_downloads_navigation_table($columns) {
		$columns = array(
			'download-product'   => __('Tên sheet', TEXTDOMAIN),
			'download-remaining' => __('Lượt tải', TEXTDOMAIN),
			'download-expires'   => __('Thời hạn', TEXTDOMAIN),
			'download-file'      => __('Tải về', TEXTDOMAIN),
		);
		return $columns;
	}

	// Rename account navigation
	public static function rename_my_account_navigation($items)
	{
		$items = array(
			'dashboard'       => __('Dashboard', TEXTDOMAIN),
			'orders'          => __('Lịch sử đặt hàng', TEXTDOMAIN),
			'downloads'       => __('Tải về', TEXTDOMAIN),
			'edit-account'    => __('Thông tin tài khoản', TEXTDOMAIN),
			'customer-logout' => __('Đăng xuất', TEXTDOMAIN),
		);
		return $items;
	}

	// Remove account enpoints
	public static function remove_my_account_links($menu_links)
	{
		//unset( $menu_links['dashboard'] );        // Remove Dashboard
		unset($menu_links['edit-address']);     // Addresses
		//unset( $menu_links['payment-methods'] );  // Remove Payment Methods
		//unset( $menu_links['orders'] );           // Remove Orders
		//unset( $menu_links['downloads'] );        // Disable Downloads
		//unset( $menu_links['edit-account'] );     // Remove Account details tab
		//unset( $menu_links['customer-logout'] );  // Remove Logout link

		return $menu_links;
	}

	// Add to cart
	public static function woocommerce_ajax_add_to_cart()
	{
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'add_to_cart')) {
			wp_send_json_error(__('Not valid', TEXTDOMAIN));
			exit;
		}

		$product_id = absint($_POST['product_id']);
		$quantity = 1;
		$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
		$product_status = get_post_status($product_id);
		$in_cart = WC()->cart->find_product_in_cart($product_id);

		// if (in_array($product_id, array_column(WC()->cart->get_cart(), 'product_id'))) {
		// 	wp_send_json_success(__("Product in cart", TEXTDOMAIN));
		// }

		if ($passed_validation && 'publish' === $product_status) {
			WC()->cart->add_to_cart($product_id, $quantity);
			$cart_items = WC()->cart->get_cart();
			$cart_items_html = '';
			foreach ($cart_items as $key => $item) {
				$product = wc_get_product($item['product_id']);
				$images = wp_get_attachment_image_src(get_post_thumbnail_id($item['product_id'], 'full'));
				$permalink = $product->get_permalink();
				$title = $product->get_title();
				$price_html = $product->get_price_html();
				$cart_items_html .= 
					"<div class='rounded-lg'>
					<div class='mb-6 rounded-lg bg-white p-6 shadow-md'>
						<a href='{$permalink}' class='block text-center cart-product-img text-center'>
							<img src='{$images[0]}' alt='{$title}' class='block mx-auto lazy'>
						</a>
						<div class='block'>
							<div class='mt-5'>
								<h2 class='text-sm font-bold text-gray-900'>
									<a href='{$permalink}'>{$title}</a>
								</h2>
								<p class='mt-1 text-xs text-gray-700'>
									{$price_html}
								</p>
							</div>
						</div>
					</div>
				</div>";
			}
			wp_send_json_success($cart_items_html);
		}
		wp_send_json_error(__("Failed", "core"));
	}

	// Login 
	public static function ajax_login()
	{
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'customer_login')) {
			wp_send_json_error(__('Not valid', TEXTDOMAIN));
			exit;
		}

		$username = $_POST['username'];
		$password = $_POST['password'];

		$user = wp_authenticate($username, $password);

		if (is_wp_error($user)) {
			wp_send_json_error(__('Email hoặc mật khẩu không chính xác.', TEXTDOMAIN));
			exit;
		}

		wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID);
		wp_send_json_success(__('Đăng nhập thành công.', TEXTDOMAIN));
	}

	// Register
	public static function ajax_register_customer()
	{
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'customer_register')) {
			wp_send_json_error(__('Not valid', TEXTDOMAIN));
			exit;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];

		if (email_exists($email)) {
			wp_send_json_error(__('Email đã được sử dụng.', TEXTDOMAIN));
			exit;
		}

		$user_data = array(
			'user_login' => $email,
			'user_email' => $email,
			'user_pass' => $password,
		);

		$user_id = wp_insert_user($user_data);

		if (is_wp_error($user_id)) {
			wp_send_json_error(__('Đăng ký không thành công, xin vui lòng thử lại.', TEXTDOMAIN));
			exit;
		}

		update_user_meta($user_id, 'billing_last_name', ' ');
		update_user_meta($user_id, 'billing_email', $email);
		wp_send_json_success(__('Done', TEXTDOMAIN));
	}
}

Core_Woocommerce::init();
