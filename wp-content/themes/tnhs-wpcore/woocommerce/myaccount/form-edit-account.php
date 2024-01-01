<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first mb-4 form-row form-row-first">
		<label for="account_first_name" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Họ của bạn', TEXTDOMAIN ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last mb-4 form-row form-row-last">
		<label for="account_last_name" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Tên của bạn', TEXTDOMAIN ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide mb-4 form-row form-row-wide">
		<label for="account_display_name" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Tên hiển thị', TEXTDOMAIN ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em class="text-sm mt-2 block"><?php esc_html_e( 'Đây sẽ là cách tên của bạn được hiển thị trong phần tài khoản và trong phần đánh giá', TEXTDOMAIN ); ?></em></span>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide mb-4 form-row form-row-wide">
		<label for="account_email" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Email', TEXTDOMAIN ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

	<fieldset>
		<legend class="text-lg font-semibold mb-3"><?php esc_html_e( 'Đổi mật khẩu', TEXTDOMAIN ); ?></legend>

		<p class="woocommerce-form-row woocommerce-form-row--wide mb-4 form-row form-row-wide">
			<label for="password_current" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Mật khẩu hiện tại (Nếu không thay đổi thì bỏ trống)', TEXTDOMAIN ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_current" id="password_current" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide mb-4 form-row form-row-wide">
			<label for="password_1" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Mật khẩu mới (Nếu không thay đổi thì bỏ trống)', TEXTDOMAIN ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_1" id="password_1" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide mb-4 form-row form-row-wide">
			<label for="password_2" class="inline-block text-gray-700 text-sm font-semibold mb-2"><?php esc_html_e( 'Nhập lại mật khẩu mới', TEXTDOMAIN ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_2" id="password_2" autocomplete="off" />
		</p>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="text-sm bg-black hover:bg-dark text-white font-semibold py-2 px-4 focus:outline-none focus:shadow-outline woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Lưu thay đổi', TEXTDOMAIN ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
