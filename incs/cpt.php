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
