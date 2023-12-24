<?php
    $general_facebook = get_field('general_facebook', 'option');
    $general_youtube = get_field('general_youtube', 'option');
    $general_instagram = get_field('general_instagram', 'option');
?>

<footer class="site-footer py-10 bg-slate-950 text-white">
    <div class="container lg:max-w-screen-lg">
        <div class="flex items-end justify-between">
            <div class="ft-info">
                <a href="<?=$general_facebook?>" class="block text-xs italic font-medium mb-1 hover:underline" target="_blank">@facebook: nguoinghienchoidan</a>
                <a href="<?=$general_instagram?>" class="block text-xs italic font-medium mb-1 hover:underline" target="_blank">@instagram: nguoinghienchoidan</a>
                <a href="<?=$general_youtube?>" class="block text-xs italic font-medium mb-1 hover:underline" target="_blank">@youtube: nguoinghienchoidan</a>
                <ul class="flex items-center mt-4">
                    <li>
                        <a href="#" class="block text-xs mr-3">Terms and Conditions</a>
                    </li>
                    <li>
                        <a href="#" class="block text-xs mr-3">Privacy Policy</a>
                    </li>
                </ul>
            </div>
            <div class="ft-copyright text-xs italic">Copyright © 2023 nguoinghienchoidan</div>
        </div>
    </div>
</footer>