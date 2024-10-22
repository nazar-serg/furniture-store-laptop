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
<section class="featured-products">
	<div class="base-container">
		<h2 class="featured-products__title title-h2">
			<?php esc_html_e('Рекомендовані колекції', 'furniturestore'); ?>
		</h2>

		<?php echo do_shortcode('[furniturestore_hit_products]'); ?>
	</div>
</section>
<section class="about">
	<div class="about__wrapper">
		<div class="about__image">
			<?php 
				$image_about = get_field('home_about_image');
				$size = 'full';
				if( $image_about ) {
					echo wp_get_attachment_image( $image_about, $size );
				}
				?>
		</div>
		<div class="about__content">
			<h2 class="about__title title-h2">
				<?php the_field('home_about_title'); ?>
			</h2>
			<div class="about__text">
				<?php the_field('home_about_text'); ?>
			</div>
			<div class="about__btn">
				<?php 
				$home_about_button = get_field('home_about_button');
				if( $home_about_button ): 
					$link_url = $home_about_button['url'];
					$link_title = $home_about_button['title'];
					$link_target = $home_about_button['target'] ? $link['target'] : '_self';
					?>
				<a class="button" href="<?php echo esc_url( $link_url ); ?>"
					target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section class="articles">
	<div class="base-container">
		<h2 class="articles__title title-h2">
			<?php esc_html_e('Статті', 'furniturestore'); ?>
		</h2>
	</div>
</section>
<section class="home-text">
	<div class="base-container">
		<div class="home-text__wrapper">
			<div class="home-text__content">
				<?php the_field('home_text'); ?>
			</div>
		</div>
		<div class="home-text__btn">
			<button class="show-more-btn button"><?php esc_html_e('Показати все', 'furniturestore'); ?></button>
			<button class="show-less-btn button"><?php esc_html_e('Закрити', 'furniturestore'); ?></button>
		</div>
	</div>
</section>
<?php get_footer(); ?>