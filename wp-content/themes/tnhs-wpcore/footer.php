<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tnhs-wpcore
 */

?>
	<footer class="site-footer py-10 bg-slate-950 text-white">
        <div class="container lg:max-w-screen-lg">
            <div class="flex items-center justify-between">
                <div class="ft-info">
                    <a href="#" class="block text-xs italic font-medium mb-1 hover:underline" target="_blank">@facebook: nguoinghienchoidan</a>
                    <a href="#" class="block text-xs italic font-medium mb-1 hover:underline" target="_blank">@instagram: nguoinghienchoidan</a>
                    <a href="#" class="block text-xs italic font-medium mb-1 hover:underline" target="_blank">@youtube: nguoinghienchoidan</a>

                    <ul class="flex items-center mt-4">
                        <li>
                            <a href="#" class="block text-xs mr-3">Terms and Conditions</a>
                        </li>
                        <li>
                            <a href="#" class="block text-xs mr-3">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="ft-payment"></div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
