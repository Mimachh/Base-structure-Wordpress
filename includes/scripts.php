<?php

function main_scripts() {
    wp_enqueue_script('main-script', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('css', get_theme_file_uri('./build/style-index.css'));
    // wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null );
    wp_enqueue_style( 'custom-font', 'https://fonts.cdnfonts.com/css/proxima-nova-2', array(), null );
    
    wp_localize_script('main-script', 'siteData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest'),
    ));
}
add_action('wp_enqueue_scripts', 'main_scripts');