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
					<h2 class="title text-2xl font-semibold text-dark uppercase">Đăng nhập</h2>
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
				</div>
			</div>
			<div class="basis-[50%] max-w-[50%] flex-none pl-6">
				<div class="box-head mb-6">
					<h2 class="title text-2xl font-semibold text-dark uppercase">Đăng ký</h2>
				</div>
				<div class="form-login">
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="email">Email</label>
						<input type="text" id="email" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập email', 'core'); ?>">
					</div>
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="email"><?php _e("Mật khẩu", "core"); ?></label>
						<input type="password" id="email" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập mật khẩu', 'core'); ?>">
					</div>
					<div class="form-group mb-4">
						<label class="block text-gray-700 text-sm font-semibold mb-2" for="email"><?php _e(" Nhập lại mật khẩu", "core"); ?></label>
						<input type="password" id="email" class="form-control shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="<?php _e('Nhập mật khẩu', 'core'); ?>">
					</div>
					<button type="button" class="text-sm bg-black hover:bg-dark text-white font-semibold py-2 px-4 focus:outline-none focus:shadow-outline"><?php _e('Đăng ký', 'core'); ?></button>
				</div>
			</div>
		</div>
	</div>
</section>

<script defer>
	document.addEventListener('DOMContentLoaded', () => {
		const btnLogin = document.querySelector('#btn-login')
		btnLogin.addEventListener('click', async (e) => {
			e.preventDefault()
			const user = document.querySelector('#email')
			const password = document.querySelector('#password')
			let target = e.currentTarget
			let data = {
				action: 'ajax_login',
				nonce: target.getAttribute('data-nonce'),
				product_id: target.getAttribute('data-product-id'),
				username: user.value,
				password: password.value,
			}

			target.classList.toggle('pending')
			const response = await post(data)

			console.log(response.text());
		})
	})
</script>