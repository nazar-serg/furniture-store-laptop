<?php

//https://woocommerce.com/document/disable-the-default-stylesheet/
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
//Карточка продукта
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', function() {
	global $product;
	echo '<h3><a href="'. $product->get_permalink() .'">' . $product->get_title() . '</a></h3>';
});

// custom shortcode for hit products
add_shortcode( 'furniturestore_hit_products', 'furniturestore_hit_products' );
function furniturestore_hit_products( $atts ){
	global $woocommerce_loop, $woocommerce;

	extract( shortcode_atts( array(
		'limit' => '12',
		'orderby' => 'date',
		'order' => 'DESC',
	), $atts ) );

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'product',
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $limit,
		'tax_query'      => array(
		array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN',
		),
	),
	);

	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

<?php while ( $products->have_posts() ) : $products->the_post(); ?>

<?php wc_get_template_part( 'content', 'hit-product' ); ?>

<?php endwhile; // end of the loop. ?>

<?php endif;

	wp_reset_postdata();

	return '
	<div class="woocommerce featured-products-list">
		<div class="owl-carousel owl-theme owl-carousel-full">
			' . ob_get_clean() . '
		</div>
		<div class="custom-nav-hit-product">
			<div class="owl-nav prev"></div>
            <div class="owl-nav next"></div>
		</div>
	</div>';
}

// Изменяем символ валюты на грн
add_filter( 'woocommerce_currency_symbol', 'change_currency_symbol_to_uah', 10, 2 );

function change_currency_symbol_to_uah( $currency_symbol, $currency ) {
    if ( $currency === 'UAH' ) {
        $currency_symbol = 'грн.';
    }
    return $currency_symbol;
}

//add class button card product
add_filter('woocommerce_loop_add_to_cart_link', function($html, $product) {

	$html = str_replace( 'class="button', 'class="button btn-custom-class-product-card', $html);
	return $html;

}, 10, 2);

//breadcrumbs
add_filter('woocommerce_breadcrumb_defaults', function($defaults) {
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb custom-breadcrumb-class" aria-label="You are here:">';
	return $defaults;
});

//ajax cart count
add_filter('woocommerce_add_to_cart_fragments', function( $fragments ) {
	$fragments['span.cart-badge'] = '<span class="cart-badge">'
								. WC()->cart->get_cart_contents_count() . 
'</span>';

return $fragments;
});

//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_filter('woocommerce_dropdown_variation_attribute_options_html', '__return_empty_string');

//add hook in title single product
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_single_product_summary', function () {
    global $product;

    if ($product->is_on_sale()) { ?>
        <span class="custom-sale-flash"><?php echo esc_html__('Sale!', 'woocommerce'); ?></span>
    <?php }
}, 7);

//remove alert variation
function disable_wc_add_to_cart_variation_script() {
    if ( is_product() ) { 
        wp_deregister_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'disable_wc_add_to_cart_variation_script', 999 );

// Убираем вкладки и выводим описание и отзывы
add_filter('woocommerce_product_tabs', 'custom_remove_product_tabs_layout', 98);

function custom_remove_product_tabs_layout($tabs) {
    return array();
}


// Вывод описания
add_action('woocommerce_after_single_product_summary', 'custom_display_product_description_and_reviews', 10);

function custom_display_product_description_and_reviews() {
    global $post, $product;

    echo '<div class="product-attributes-image-container">';

    $attributes = $product->get_attributes();
    if (!empty($attributes)) {
        echo '<div class="product-attributes">';
        echo '<h2 class="section-title title-h2"><span>' . __('Атрибути продукту', 'furniturestore') . '</span></h2>';
        echo '<table class="product-attributes-table">';
        echo '<tbody>';

        foreach ($attributes as $attribute) {
            echo '<tr>';
            echo '<th>' . wc_attribute_label($attribute->get_name()) . '</th>';

            $values = $attribute->is_taxonomy()
                ? wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'))
                : $attribute->get_options();
            echo '<td>' . esc_html(implode(', ', $values)) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    echo '<div class="product-image">';
    if (has_post_thumbnail($product->get_id())) {
        echo get_the_post_thumbnail($product->get_id(), 'full'); 
    }
    echo '</div>';

    echo '</div>';

	// Проверка и вывод описания
    if (!empty(get_the_content())) {
        echo '<div class="custom-product-description">';
        echo '<h2 class="section-title title-h2"><span>' . __('Більше інформації', 'furniturestore') . '</span></h2>';
        the_content();
        echo '</div>';
    }

    // Вывод блока отзывов
    echo '<div class="custom-product-comments">';
    echo '<h2 class="section-title title-h2"><span>' . __('Відгуки', 'furniturestore') . '</span></h2>';
    comments_template();
    echo '</div>';
}


//Repeate fields single product reassurance
add_action('woocommerce_after_single_product_summary', function() {

    if (have_rows('single_product_reassurance', 'option')) { ?>
        <div class="product-reassurance">
            <?php while(have_rows('single_product_reassurance', 'option')) : the_row();
            $icon = get_sub_field('icon');
            $title = get_sub_field('title');
            $text = get_sub_field('text');
            ?>
            <div class="product-reassurance__item">
                <div class="product-reassurance__header">
                    <div class="product-reassurance__icon">
                        <i class="fa <?php echo esc_html($icon); ?>" aria-hidden="true"></i>
                    </div>
                    <h3 class="product-reassurance__title">
                        <?php echo esc_html($title); ?>
                    </h3>
                </div>
                <div class="product-reassurance__text">
                    <?php echo esc_html($text); ?>
                </div>
            </div>

            <?php endwhile; ?>
        </div>
    <?php }

}, 5);

//attr color variation product
add_action('woocommerce_single_product_summary', function() {
    global $product;

    if ( $product->is_type( 'variable' ) ) {
        $available_variations = $product->get_available_variations();
        $attributes = $product->get_variation_attributes();
        $attribute_name = 'attribute_' . array_keys($attributes)[0];
        ?>
        
        <select name="color-options" id="color-options" style="display: none;">
            <?php foreach ( $available_variations as $variation ) : 
                $variation_id = $variation['variation_id'];
                $color_slug = $variation['attributes'][ $attribute_name ]; 
                ?>
                <option value="<?php echo esc_attr( $variation_id ); ?>"><?php echo ucfirst($color_slug); ?></option>
            <?php endforeach; ?>
        </select>
        <div class="attr-color-options">
            <h4><?php esc_html_e('Виберіть колір', 'furniturestore'); ?></h4>
            <div class="color-options">
                <?php foreach ( $available_variations as $variation ) :
                    $color_slug = $variation['attributes'][ $attribute_name ];
                    $color_name = ucfirst($color_slug);
                    $image_url = $variation['image']['src'];
                    ?>
                    <div 
                        class="color-option color-<?php echo esc_attr( $color_slug ); ?>" 
                        data-variation-id="<?php echo esc_attr( $variation['variation_id'] ); ?>"
                        data-image="<?php echo esc_url( $image_url ); ?>"
                        title="<?php echo esc_attr( $color_name ); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
    }
}, 24);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

/**
 * add description after content - page category
 */
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
add_action('woocommerce_after_shop_loop', function() {

    if (is_product_category() || is_shop()) { ?>

<div class="desc-category">
	<?php echo woocommerce_taxonomy_archive_description(); ?>
</div>

<?php
    }
	
}, 10);

/**
 * Hide woocommerce notices page category
 */
function hide_woocommerce_notices_on_category() {
    if (is_product_category() || is_shop()) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
    }
}
add_action('wp', 'hide_woocommerce_notices_on_category');


/**
 * Check if the product is in stock
 */

 add_action('woocommerce_single_product_summary', function() {
    global $product;

    if ($product->is_in_stock()) {
        $stock_quantity = $product->get_stock_quantity();

        if ($stock_quantity > 0) {
            echo '<p class="custom-stock in-stock"><i class="fa fa-check" aria-hidden="true"></i>' . esc_html__('В наявності', 'furniturestore') . '</p>';
        } else {
            echo '<p class="custom-stock out-of-stock">' . esc_html__('Немає у наявності', 'furniturestore') . '</p>';
        }
    } else {
        echo '<p class="custom-stock out-of-stock">' . esc_html__('Немає у наявності', 'furniturestore') . '</p>';
    }
 }, 4);

/**
 * Breadcrumbs
 */
 function custom_breadcrumbs() {
    echo '<ul class="breadcrumbs page-breadcrumbs">';
    
    if (!is_home()) {
        echo '<li><a href="' . home_url() . '">Головна</a></li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo '</li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            echo '<li>';
            echo the_title();
            echo '</li>';
        }
    }
    
    echo '</ul>';



























