<?php get_header(); ?>

<?php
do_action( 'woocommerce_before_main_content' );
$custom_class_for_product = (is_tax('product_cat')) || is_shop() ? 'products-wrapper' : 'products-wrapper-no-flex';
?>
<div class="<?php echo esc_attr($custom_class_for_product); ?>">
<?php if ( !is_search() ): ?>
<div class="sidebar-column">
	<?php do_action( 'woocommerce_sidebar' ); ?>
</div><!--./sidebar-column-->
<?php endif; ?>

<div class="products-column">
	<?php
				do_action( 'woocommerce_shop_loop_header' );

				if ( woocommerce_product_loop() ) { ?>

	<div class="products-header">
		<?php do_action( 'woocommerce_before_shop_loop' ); ?>
	</div>
					
	<?php

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();

					do_action( 'woocommerce_after_shop_loop' );
				} else {
			
					do_action( 'woocommerce_no_products_found' );
				}
			?>

			<div class="custom-modal-cart">
				<div class="custom-modal-cart__modal">
				<div class="custom-ajax-loader">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/ripple.svg" alt="">
					</div>
				<span class="close">×</span>
					<div class="custom-modal-cart__your-order">
						<?php woocommerce_mini_cart(); ?>
						</div>
						<div class="custom-modal-cart__content">
							<a class="custom-modal-cart__btn-continue-shopping button"><?php esc_html_e('Продовжити покупки', 'furniturestore'); ?></a>
							<a class="custom-modal-cart__btn-order button" href="<?php echo wc_get_checkout_url(); ?>"><?php esc_html_e('Оформити замовлення', 'furniturestore'); ?></a>
						</div>
				</div>
			</div>

</div><!-- ./products-column-->
</div><!--./products-wrapper-->
<?php
do_action( 'woocommerce_after_main_content' );
?>

<?php get_footer(); ?>