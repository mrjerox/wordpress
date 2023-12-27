<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<section class="box-login-page py-12">
	<div class="container lg:max-w-screen-lg">
		<div class="flex">
			<div class="basis-[50%] max-w-[50%] flex-none pr-6">
				<div class="box-head mb-6">
					<h2 class="title text-2xl font-semibold text-dark uppercase"><?php _e('Đăng nhập', 'core');?></h2>
				</div>
				<div class="form-login">
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="email">Email</label>
						<input type="text" id="email" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập email', 'core'); ?>">
					</div>
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="password"><?php _e("Mật khẩu", "core"); ?></label>
						<input type="password" id="password" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập mật khẩu', 'core'); ?>">
					</div>
					<button type="button" id="btn-login" data-nonce="<?= wp_create_nonce('customer_login') ?>" class="btn text-sm bg-black hover:bg-dark text-white font-semibold py-2 px-4 focus:outline-none focus:shadow-outline"><?php _e('Đăng nhập', 'core'); ?></button>
					<a class="inline-block align-baseline font-semibold text-sm text-dark hover:underline ml-4" href="#">
						<?php _e('Quên mật khẩu', 'core'); ?>?
					</a>
					<p id="login-message" class="text-sm text-red-600 font-semibold mt-4"></p>
				</div>
			</div>
			<div class="basis-[50%] max-w-[50%] flex-none pl-6">
				<div class="box-head mb-6">
					<h2 class="title text-2xl font-semibold text-dark uppercase"><?php _e('Đăng ký', 'core');?></h2>
				</div>
				<div class="form-login">
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="register-email">Email</label>
						<input type="text" id="register-email" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập email', 'core'); ?>">
					</div>
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="register-password"><?php _e("Mật khẩu", "core"); ?></label>
						<input type="password" id="register-password" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập mật khẩu', 'core'); ?>">
					</div>
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="register-repassword"><?php _e(" Nhập lại mật khẩu", "core"); ?></label>
						<input type="password" id="register-repassword" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập mật khẩu', 'core'); ?>">
					</div>
					<button type="button" id="btn-register" class="text-sm bg-black hover:bg-dark text-white font-semibold py-2 px-4 focus:outline-none focus:shadow-outline"><?php _e('Đăng ký', 'core'); ?></button>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?=THEME_ASSETS?>/scripts/login.min.js" defer></script>