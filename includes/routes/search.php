<?php

add_action('rest_api_init', 'site_custom_api_search');

function site_custom_api_search() {
    register_rest_route('mamiejacquotte/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'siteSearchResults'
    ));
}

function siteSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post','page'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),


    );


    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if(get_post_type() == 'post' OR get_post_type() == 'page') {


            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'thumbnail' => get_the_post_thumbnail_url(0, 'postThumbnail'),
            ));
        }

    };

        $results['generalInfo'] = array_values(array_unique($results['generalInfo'], SORT_REGULAR));
    return $results;
}