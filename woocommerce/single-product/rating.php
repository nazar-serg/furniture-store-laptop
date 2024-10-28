<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>

<div class="woocommerce-product-rating">
	<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
	<?php if ( comments_open() ) : ?>

	<span class="count">(<?php esc_html_e( $review_count ); ?>)</span>

	<?php endif ?>
</div>

<?php endif; ?>