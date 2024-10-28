<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

<section class="up-sells upsells products featured-products-list">
	<?php
		$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
	<h2 class="section-title title-h2"><span><?php echo esc_html( $heading ); ?></span></h2>
	<?php endif; ?>

	<div class="owl-carousel owl-theme owl-carousel-full">
		<?php //woocommerce_product_loop_start(); ?>

		<?php foreach ( $upsells as $upsell ) : ?>

		<?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part( 'content', 'hit-product' );
				?>

		<?php endforeach; ?>

		<?php //woocommerce_product_loop_end(); ?>
	</div>
	<!--./owl-carousel owl-theme owl-carousel-full-->
	<div class="custom-nav-hit-product">
		<div class="owl-nav prev"></div>
		<div class="owl-nav next"></div>
	</div>

</section>

<?php
endif;

wp_reset_postdata();