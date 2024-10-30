<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$custom_class_for_product = (is_tax('product_cat')) ? 'products-row' : 'products-row-grid';
?>
<div class="products <?php echo esc_attr($custom_class_for_product); ?>">