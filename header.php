<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="<?php bloginfo('charset'); ?>" >
        <meta name="description" content="<?php Description(); ?>"/>
        <meta name="keywords" content="<?php Keywords(); ?>">
    </head>
    <body <?php body_class(); ?> class="relative">
    <header>
            <div class="logo-header">
                <a href="<?php echo home_url('/'); ?>"
                aria-label="Logo menant à la page principale"
                >
                    <?php if(has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo bloginfo('title');
                    } ?>
                </a>
            </div>

            <!-- Desktop Nav -->
            <nav class="nav_desktop nav-links">
               <ul>
                    <li><a href="<?php echo home_url('/'); ?> " 
                        <?php if (is_front_page()) echo 'class="active"' ?>
                        aria-label="Retour à la page principale"
                        >Accueil</a>
                    </li>
                    <li><a href="<?php echo esc_url(site_url('blog')) ?>" 
                        <?php if (get_post_type() == 'post') echo 'class="active"' ?>
                        aria-label="Voir les recettes"
                        >Recettes</a>
                    </li>
                    <?php 
                        if(is_user_logged_in()) { ?>
                            <li>
                                <a href="<?php echo esc_url(site_url('mon-carnet-de-recettes')) ?>"
                                aria-label="Voir mon carnet de recettes"
                                <?php if (is_page('mon-carnet-de-recettes') OR wp_get_post_parent_id(0) == 136) echo 'class="active"' ?>
                                >
                                    Mon Carnet de recettes
                                </a>  
                            </li>   
                        <?php }
                    ?>
                    <li>
                        <?php 
                            if(is_user_logged_in()) { ?>
                                <a href="<?php echo wp_logout_url(); ?>"
                                aria-label="Me déconnecter">
                                <!-- <span><?php echo get_avatar(get_current_user_id(), 20); ?></span> -->
                                <span>Déconnexion</span>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo wp_login_url(); ?>"
                                aria-label="Me connecter"
                                >Se connecter</a>

                            <?php }
                        ?>
                    </li>
                    
                    <li class="js-search-trigger">
                        <a href="<?php echo esc_url(site_url('/recherche')); ?>" target="_blank" aria-label="Recherchez sur le site" title="Recherche">
                            <span class="">
                                <svg class="my-search-svg"  xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </span>
                        </a>
                    </li>
               </ul>
            </nav>

            <!-- Mobile Nav -->
            <nav class="nav_mobile">
                <ul>
                    <li><a href="<?php echo home_url('/'); ?>"
                        aria-label="Retour à la page principale"
                        >Accueil</a></li>
                    <li><a href="<?php echo esc_url(site_url('blog')) ?>" <?php if (get_post_type() == 'post') echo 'class="active"' ?>
                        aria-label="Voir les recettes"
                        >Recettes</a></li>
                    <?php 
                        if(is_user_logged_in()) { ?>
                            <li>
                                <a href="<?php echo esc_url(site_url('mon-carnet-de-recettes')) ?>"
                                aria-label="Voir mon carnet de recettes"
                                <?php if (is_page('mon-carnet-de-recettes') OR wp_get_post_parent_id(0) == 136) echo 'class="active"' ?>
                                >
                                    Mon Carnet de recettes
                                </a>  
                            </li>   
                        <?php }
                    ?>
                    <li>
                        <?php 
                            if(is_user_logged_in()) { ?>
                                <a href="<?php echo wp_logout_url(); ?>"
                                aria-label="Me déconnecter"
                                >
                                <span><?php echo get_avatar(get_current_user_id(), 20); ?></span>
                                <span>Déconnexion</span>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo wp_login_url(); ?>"
                                aria-label="Me connecter"
                                >Se connecter</a>

                            <?php }
                        ?>
                    </li>
                    <li class="js-search-trigger my-search-svg mobile-search">
                        <a href="<?php echo esc_url(site_url('/recherche')); ?>" aria-label="Recherchez sur le site" title="Recherche">
                            <span>
                                <svg aria-hidden="true"  xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                  
               </ul>
            </nav>

            <div class="toggle-hamburger">
                <svg class="toggle-hamburger-svg-open" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M64 192h896v76.8H64V192z m0 281.6h896v76.8H64V473.6z m0 281.6h896V832H64v-76.8z" fill="currentColor"></path></g></svg>
                
                <svg class="toggle-hamburger-svg-close" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                </svg>
            </div>
    </header>
