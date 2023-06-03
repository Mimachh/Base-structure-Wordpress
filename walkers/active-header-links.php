<?php
class Active_Header_Link_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $active_class = '';

        // Vérifie si l'élément du menu est la page en cours
        if (in_array('current-menu-item', $classes)) {
            $active_class = 'active';
        }

        // Vérifie si l'élément du menu correspond à la page du blog
        if (is_singular('post') && $item->title === 'Blog') {
            $active_class = 'active';
        }

        // Vérifie si l'élément du menu correspond à une archive de type blog
        if (is_post_type_archive('post') && $item->title === 'Blog') {
            $active_class = 'active';
        }

        $output .= '<li class="' . esc_attr(implode(' ', $classes)) . '">';
        $output .= $args->before;
        $output .= '<a href="' . esc_url($item->url) . '" class="' . esc_attr($active_class) . '">';
        $output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $output .= '</a>';
        $output .= $args->after;
    }

    public function get_active_class($menu_item, $class = 'active') {
        if (is_page($menu_item) || (get_post_type() == $menu_item)) {
            return $class;
        }

        // Vérifie si l'élément du menu correspond à la page du blog
        if (is_singular('post') && $menu_item->title === 'Blog') {
            return $class;
        }

        return '';
    }

    function is_active($menu_item) {
        global $post;
    
        // Vérifie si l'élément du menu correspond à la page en cours
        if (is_page($menu_item) && $post->ID == $menu_item->object_id) {
            return true;
        }
    
        // Vérifie si l'élément du menu correspond à la page du blog en cours
        if (is_home() && $menu_item->title === 'Blog') {
            return true;
        }
    
        // Autres conditions de correspondance pour les types de contenu personnalisés, etc.
    
        return false;
    }
}


