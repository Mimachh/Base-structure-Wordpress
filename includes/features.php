<?php 

function features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('postLandscape', 400, 260, true);
    add_image_size('postThumbnail', 200, 200, true);
    add_image_size('postPortrait', 500, 700, true);
    add_image_size('pageBanner', 1920, 350, true);
    add_image_size('ingredientThumbnail', 200, 300, true);
}
add_action('after_setup_theme', 'features');