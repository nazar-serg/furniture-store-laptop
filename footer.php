<footer class="footer" id="footer">
	<div class="base-container">
		<div class="footer__wrapper">
			<div class="footer__column">
				<div class="footer__logo">
					<?php 
					$logo_footer = get_field('logo_footer', 'option');
					$size = 'full';
					if( $logo_footer ) {
						echo wp_get_attachment_image( $logo_footer, $size );
					}
					?>
				</div>
				<div class="footer__social">
					<ul>
						<?php
					if ( have_rows('social_footer', 'option') ):
						
					while ( have_rows('social_footer', 'option') ): the_row();		
					
					$get_icon = get_sub_field('icon');
					$get_link = get_sub_field('link');
					?>
						<li>
							<a href="<?php echo $get_link; ?>">
								<i class="<?php echo $get_icon; ?>"></i>
							</a>
						</li>
						<?php 
					endwhile;

					endif;
					?>
					</ul>
				</div>

			</div>

			<div class="footer__column">
				<div class="footer__menu">
					<h4><?php _e('Меню', 'furniturestore'); ?></h4>
					<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-menu',
					'container' => null,
					'menu_class' => 'navbar-nav',
				));
				?>
				</div>
			</div>

			<div class="footer__column">
				<div class="footer__info">
					<h4><?php _e('Інформація', 'furniturestore'); ?></h4>
					<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-menu-info',
					'container' => null,
					'menu_class' => 'navbar-nav',
				));
				?>
				</div>
			</div>

			<div class="footer__column">
				<div class="footer__contacts">
					<h4><?php _e('Телефони для замовлень', 'furniturestore'); ?></h4>
					<ul>
						<?php
					if ( have_rows('footer_phone', 'option') ):
						
					while ( have_rows('footer_phone', 'option') ): the_row();		
					
					$get_phone = get_sub_field('phone');
					
					?>
						<li>
							<a href="tel:<?php echo $get_phone; ?>">
								<?php echo $get_phone; ?>
							</a>
						</li>
						<?php 
					endwhile;

					endif;
					?>
					</ul>
					<ul class="opening-hours">
						<li>
							<strong><?php echo the_field('opening_hours_title', 'option'); ?></strong>
						</li>
						<li>
							<?php echo the_field('opening_hours_text', 'option'); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="footer__copyright">
					<?php echo the_field('copyright', 'option'); ?> © <?php echo date('Y'); ?>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>

<?php wp_footer(); ?>

</body>

</html>