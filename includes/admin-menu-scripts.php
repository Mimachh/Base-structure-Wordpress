<?php 

function add_login_registration_links_to_menu($items, $args) {
    // Vérifiez si le menu est celui que vous souhaitez modifier
    if ($args->theme_location === 'footerMenuLocationOne') {
        // Ajoutez le lien "Se connecter"
        $login_link = '<li><a href="' . wp_login_url() . '">Se connecter</a></li>';
        // Ajoutez le lien "S'inscrire"
        $registration_link = '<li><a href="' . wp_registration_url() . '">S\'inscrire</a></li>';

        // Ajoutez les liens à la fin des éléments de menu
        $items .= $login_link;
        $items .= $registration_link;
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_login_registration_links_to_menu', 10, 2);


function admin_scripts() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocationOne', 'Footer Location One');
    register_nav_menu('footerMenuLocationTwo', 'Footer Location Two');
}
add_action('after_setup_theme', 'admin_scripts');

