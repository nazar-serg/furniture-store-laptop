<?php
defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>
<?php do_action( 'woocommerce_before_main_content' ); ?>


<div class="my-account-page">
	<div>
		<div class="my-account-page__wrapper">
			<div class="my-account-page__column-left">
				<?php do_action( 'woocommerce_account_navigation' ); ?>
			</div>
			<div class="my-account-page__column-right">
				<div class="woocommerce-MyAccount-content">
					<?php
                    do_action( 'woocommerce_account_content' );
            ?>
				</div>
			</div>
		</div>

	</div>
</div>


<?php do_action( 'woocommerce_after_main_content' ); ?>