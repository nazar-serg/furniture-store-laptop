<?php

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-content-wrapper', $product ); ?>>
	<div class="product-content-wrapper__body">
	<div class="product-content-wrapper__image">
		<?php
		$attachment_ids = $product->get_gallery_image_ids();

		if ($attachment_ids) {
			echo '<div class="product-content-wrapper__image-carousel owl-carousel">';
			foreach ($attachment_ids as $attachment_id) {
				$image_url = wp_get_attachment_image_url($attachment_id, 'full');
				$image_thumb_url = wp_get_attachment_image_url($attachment_id, 'thumbnail'); 
	
				echo '<div class="item">';
				echo '<a href="' . esc_url($image_url) . '" data-fancybox="gallery">';
				echo '<img src="' . esc_url($image_thumb_url) . '" alt="">';
				echo '</a>';
				echo '</div>';
			}
			echo '</div>';
		} else {
			woocommerce_show_product_images();
		}
		?>
	
	</div><!--./product-content-wrapper__image-->

	<div class="product-content-wrapper__info">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!--./product-content-wrapper__info-->
</div><!--./product-content-wrapper__body-->

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
