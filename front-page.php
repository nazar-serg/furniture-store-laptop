<?php get_header(); ?>
<section class="hero">
	<div class="base-container">
		<div class="hero__wrapper">
			<div class="hero__content">
				<h1 class="hero__title">
					<?php the_field('hero_title'); ?>
				</h1>
				<div class="hero__text">
					<?php the_field('hero_text'); ?>
				</div>
				<div class="hero__btn">
					<?php 
				$hero_button = get_field('hero_button');
				if( $hero_button ): 
					$link_url = $hero_button['url'];
					$link_title = $hero_button['title'];
					$link_target = $hero_button['target'] ? $link['target'] : '_self';
					?>
					<a class="hero__btn-link button" href="<?php echo esc_url( $link_url ); ?>"
						target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="hero__image">
				<?php 
				$image = get_field('hero_image');
				$size = 'full';
				if( $image ) {
					echo wp_get_attachment_image( $image, $size );
				}
				?>
			</div>
		</div>
	</div>
</section>
<section class="all-category">
	<div class="base-container">
		<h2 class="all-category__title title-h2">
			<?php esc_html_e('Виберіть свою категорію', 'furniturestore'); ?>
		</h2>

		<?php echo do_shortcode('[woocommerce_categories]'); ?>
	</div>
</section>
<?php get_footer(); ?>