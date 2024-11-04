<?php

function custom_blog_post_type() {
    $labels = array(
        'name'                  => 'Блог',
        'singular_name'         => 'Запис',
        'menu_name'             => 'Блог',
        'name_admin_bar'        => 'Блог',
        'add_new'               => 'Додати нову',
        'add_new_item'          => 'Додати нову запис',
        'new_item'              => 'Нова запис',
        'edit_item'             => 'Редагувати запис',
        'view_item'             => 'Переглянути запис',
        'all_items'             => 'Усі записи',
        'search_items'          => 'Пошук записів',
        'parent_item_colon'     => 'Батьківські записи:',
        'not_found'             => 'Записів не знайдено',
        'not_found_in_trash'    => 'Записи в кошику не знайдено'
    );
    
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'blog' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-write-blog',
        'supports'              => array( 'title', 'thumbnail' ),
    );

    register_post_type( 'blog', $args );
}

add_action( 'init', 'custom_blog_post_type' );



function custom_reviews_post_type() {
    $labels = array(
        'name'                  => 'Відгуки',
        'singular_name'         => 'Відгук',
        'menu_name'             => 'Відгуки',
        'name_admin_bar'        => 'Відгуки',
        'add_new'               => 'Додати нову',
        'add_new_item'          => 'Додати нову Відгук',
        'new_item'              => 'Нова Відгук',
        'edit_item'             => 'Редагувати Відгук',
        'view_item'             => 'Переглянути Відгук',
        'all_items'             => 'Усі Відгуки',
        'search_items'          => 'Пошук Відгуків',
        'parent_item_colon'     => 'Батьківські Відгуки:',
        'not_found'             => 'Відгуків не знайдено',
        'not_found_in_trash'    => 'Відгук в кошику не знайдено'
    );
    
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'reviews' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-format-status',
        'supports'              => array( 'title', 'editor' ),
    );

    register_post_type( 'reviews', $args );
}

add_action( 'init', 'custom_reviews_post_type' );
