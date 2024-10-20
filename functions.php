<?php
//Woocommerce
add_action( 'after_setup_theme', function() {
    load_theme_textdomain( 'furniturestore', get_template_directory() . '/languages' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'wc-product-gallery-lightbox' );
     
    register_nav_menus(
        array(
            'header-menu' => __( 'Header menu', 'furniturestore' ),
        )
        );
});

//Styles
function furniturestore_theme_enqueue_styles() {
    wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script('furniturestore-main-js', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.1', true);
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap');
    wp_enqueue_style('furniturestore-main-css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'furniturestore_theme_enqueue_styles');

require_once get_template_directory() . './incs/woocommerce-hooks.php';
require_once get_template_directory() . './incs/class-awp-menu-walker.php';
require_once get_template_directory() . './incs/cpt.php';