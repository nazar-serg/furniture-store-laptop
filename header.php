<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="wrapper">
		<header class="header">
			<div class="base-container">
				<div class="nav-menu">
					<div class="navbar">
						<div class="navbar__wrapper">
							<i class="fa fa-bars"></i>
							<div class="nav-menu__logo">
								<?php if( has_custom_logo() ): ?>
								<?php echo the_custom_logo(); ?>
								<?php endif; ?>
							</div>
							<nav class="nav-links">
								<div class="icon-close">
									<i class="fa fa-times"></i>
								</div>
								<div id='main-menu'>
									<?php
                            if ( has_nav_menu( 'header-menu' )) {
                            wp_nav_menu([
                                'theme_location'  => 'header-menu',
                                'menu_class'      => 'menu-list',
                                'link_class'      => 'menu-link',
                                'add_li_class'    => 'menu-item',
                                'container'       => 'null',
                                'walker' => new AWP_Menu_Walker()
                            ]);
                        }
                        ?>
								</div>
							</nav>
							<div class="navbar__info">
								<div class="navbar__search">Пошук</div>
								<div class="navbar__account">
									<?php 
									$link_account = get_field('account', 'option');
									if( $link_account ): 
										$link_url = $link_account['url'];
										$link_title = $link_account['title'];
										$link_target = $link_account['target'] ? $link['target'] : '_self';
										?>
									<a href="<?php echo esc_url( $link_url ); ?>"
										target="<?php echo esc_attr( $link_target ); ?>">
										<i class="fa fa-user" aria-hidden="true"></i>
									</a>
									<?php endif; ?>

								</div>
								<?php if (! is_cart()): ?>
								<div class="navbar__cart">
									<img class="navbar__cart-icon"
										src="<?php echo get_template_directory_uri() . '/assets/images/icon/shopping-cart.png'; ?>"
										alt="Icon cart">
									<span class="navbar__conuter-cart">
										<?php echo WC()->cart->get_cart_contents_count(); ?>
									</span>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>