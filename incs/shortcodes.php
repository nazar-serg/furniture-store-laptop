<?php
//all categories
function display_woocommerce_categories_with_images() {
    $args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
    );

    $product_categories = get_terms($args);

    if (!empty($product_categories)) {
        echo '<div class="categories-grid">';
        foreach ($product_categories as $category) {
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $category_image = wp_get_attachment_url($thumbnail_id);
            $category_link = get_term_link($category->term_id, 'product_cat');

            echo '<div class="category-item">';
                if ($category_image) {
                    echo '<a href="' . esc_url($category_link) . '"><img src="' . esc_url($category_image) . '" alt="' . esc_attr($category->name) . '"></a>';
                }
                echo '<h3><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></h3>';
            echo '</div>';
        }
        echo '</div>';
    }
}
add_shortcode('woocommerce_categories', 'display_woocommerce_categories_with_images');