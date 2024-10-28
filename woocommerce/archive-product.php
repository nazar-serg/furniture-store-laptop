<?php get_header(); ?>

<?php
do_action( 'woocommerce_before_main_content' );
?>
<div class="products-wrapper">
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

</div><!-- ./products-column-->
</div><!--./products-wrapper-->
<?php
do_action( 'woocommerce_after_main_content' );
?>

<?php get_footer(); ?>