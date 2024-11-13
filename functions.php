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
            'footer-menu' => __( 'Footer menu', 'furniturestore' ),
            'footer-menu-info' => __( 'Footer menu info', 'furniturestore' ),
        )
        );
});


//Styles
function furniturestore_theme_enqueue_styles() {

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script('jquery');
    
    wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
    
    wp_enqueue_script('furniturestore-main-js', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.3', true);
    
    wp_localize_script('furniturestore-main-js', 'reviewStrings', array(
        'leaveReview' => esc_html__('Залишити відгук', 'furniturestore'),
        'hideReview' => esc_html__('Приховати', 'furniturestore')
    ));

    wp_localize_script('furniturestore-main-js', 'furniturestore_wishlist_object', [
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('furniturestore_wishlist_nonce')
    ]);

    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap');
    wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('furniturestore-main-css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.3', 'all');
}

add_action('wp_enqueue_scripts', 'furniturestore_theme_enqueue_styles');

/**
 * Ajax for wishlist
 */

add_action('wp_ajax_furniturestore_wishlist_action', 'furniturestore_wishlist_action_cb');
add_action('wp_ajax_nopriv_furniturestore_wishlist_action', 'furniturestore_wishlist_action_cb');

function furniturestore_wishlist_action_cb() {

    if ( ! isset($_POST['nonce'])) {
        echo json_encode(['status' => 'error', 'answer' => __('Security error 1', 'furniturestore')]);
        wp_die();
    }

    if ( ! wp_verify_nonce($_POST['nonce'], 'furniturestore_wishlist_nonce') ) {
        echo json_encode(['status' => 'error', 'answer' => __('Security error 2', 'furniturestore')]);
        wp_die();
    }

    $product_id = (int) $_POST['product_id'];
    $product = wc_get_product($product_id);

    if (!$product || $product->get_status() !== 'publish') {
        echo json_encode(['status' => 'error', 'answer' => __('Error product', 'furniturestore')]);
        wp_die();
    }

    $wishlist = furniturestore_get_withlist();
    if (false !== ($key = array_search($product_id, $wishlist))) {
        unset( $wishlist[$key] );
		$answer = json_encode( [ 'status' => 'success', 'answer' => __( 'The product hase been removed from wishlist', 'furniturestore' ) ] );
    } else {
        if (count($wishlist) >= 4) {
            array_shift($wishlist);
        }
        $wishlist[] = $product_id;
        $answer = json_encode(['status' => 'success', 'answer' => __('The product hase been added to wishlist', 'furniturestore')]);
    }

    $wishlist = implode(',', $wishlist);
    setcookie('furniturestore_wishlist', $wishlist, time() + 3600 * 24 * 30, '/');

    wp_die($answer);
}

function furniturestore_get_withlist() {
    $wishlist = isset($_COOKIE['furniturestore_wishlist']) ? $_COOKIE['furniturestore_wishlist'] : [];

    if ($wishlist) {
        $wishlist = explode(',', $wishlist);
    }

    return $wishlist;
}

// function add_to_wishlist() {
    
//     if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'furniturestore_wishlist_nonce')) {
//         wp_send_json_error("Security check failed");
//         return;
//     }

//     if (!isset($_POST['product_id'])) {
//         wp_send_json_error("No product ID provided");
//         return;
//     }

//     $product_id = intval($_POST['product_id']);
//     $wishlist = isset($_COOKIE['wishlist']) ? json_decode(stripslashes($_COOKIE['wishlist']), true) : [];

//     if (!in_array($product_id, $wishlist)) {
//         $wishlist[] = $product_id;
//     }


//     setcookie('wishlist', json_encode($wishlist), time() + 30 * DAY_IN_SECONDS, '/');

//     wp_send_json_success("Product added to wishlist");
// }

// add_action('wp_ajax_add_to_wishlist', 'add_to_wishlist');
// add_action('wp_ajax_nopriv_add_to_wishlist', 'add_to_wishlist');


// function remove_from_wishlist() {

//     // Проверка nonce для безопасности
//     if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'furniturestore_wishlist_nonce' ) ) {
//         wp_send_json_error("Invalid nonce");
//         return;
//     }

//     if ( isset( $_POST['product_id'] ) ) {
//         $product_id = intval( $_POST['product_id'] );
        
//         // Убираем товар из cookie
//         if ( isset($_COOKIE['wishlist'])) {
//             $wishlist = json_decode(stripslashes($_COOKIE['wishlist']), true);
//             if (in_array($product_id, $wishlist)) {
//                 $wishlist = array_diff($wishlist, [$product_id]);  // Удаляем товар
//                 setcookie('wishlist', json_encode(array_values($wishlist)), time() + 3600, '/');  // Обновляем cookie
//             }
//         }

//         wp_send_json_success("Product removed from wishlist");
//     } else {
//         wp_send_json_error("No product ID provided");
//     }
// }
// add_action('wp_ajax_remove_from_wishlist', 'remove_from_wishlist');
// add_action('wp_ajax_nopriv_remove_from_wishlist', 'remove_from_wishlist');

// function display_wishlist() {
//     if (!isset($_COOKIE['wishlist'])) {
//         return "<p>Your wishlist is empty.</p>";
//     }

//     $wishlist = json_decode(stripslashes($_COOKIE['wishlist']), true);
//     if (empty($wishlist)) {
//         return "<p>Your wishlist is empty.</p>";
//     }

//     $args = [
//         'post_type' => 'product',
//         'posts_per_page' => 8,
//         'post__in' => $wishlist,
//         'orderby' => 'post__in',
//     ];

//     $query = new WP_Query($args);

//     if (!$query->have_posts()) {
//         return "<p>Your wishlist is empty.</p>";
//     }

//     ob_start();
//     echo '<ul class="wishlist-products">';
//     while ($query->have_posts()) {
//         $query->the_post();
//         wc_get_template_part('content', 'wishlist-product');
//     }
//     echo '</ul>';

//     wp_reset_postdata();
//     return ob_get_clean();
// }

// add_shortcode('wishlist', 'display_wishlist');


/**
 * end Ajax for wishlist
 */

/**
 * Adding a class to "a"
 */
function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

/**
 * Adding a class to "li"
 */
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

/**
 * Custom sidebar for shop
 */
add_action( 'widgets_init', function() {

    register_sidebar( array(
        'name'          => __('Custom Sidebar', 'furniturestore'),
        'id'            => 'sidebar-1',
        'description'   => __('This is a custom sidebar.', 'furniturestore'),
        'before_widget' => '<div class="widget custom-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
} );

/**
 * Breadcrumbs
 */
function custom_breadcrumbs() {

    $separator = ' / ';
    $home_title = esc_html('Главная', 'furniturestore');
    echo '<nav class="custom-breadcrumbs">';

    echo '<a href="' . home_url() . '">' . $home_title . '</a>' . $separator;

    if (is_post_type_archive('blog')) {
        echo '<span>' . esc_html('Блог', 'furniturestore') . '</span>';

    } elseif (is_singular('blog')) {
        echo '<a href="' . get_post_type_archive_link('blog') . '">' . esc_html('Блог', 'furniturestore') . '</a>' . $separator;
        echo '<span>' . get_the_title() . '</span>';

    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>' . $separator;
            }
        }
        echo '<span>' . get_the_title() . '</span>';

    } elseif (is_search()) {
        echo '<span>' . esc_html('Результати пошуку:', 'furniturestore') . " " . get_search_query() . '</span>';

    } elseif (is_404()) {
        echo '<span>' . esc_html('Помилка 404', 'furniturestore') . '</span>';
    }

    echo '</nav>';
}



require_once(get_template_directory() . '/incs/cpt.php');
require_once(get_template_directory() . '/incs/woocommerce-hooks.php');
require_once(get_template_directory() . '/incs/class-awp-menu-walker.php');
require_once(get_template_directory() . '/incs/shortcodes.php');
