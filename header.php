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
	<a href="#" id="scrollTopBtn">
    	<i class="fa fa-angle-up" aria-hidden="true"></i>
	</a>
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
								<div class="navbar__search-full-container">
									<div class="base-container">
									<button class="close-btn">&times;</button>
									<?php aws_get_search_form( true ); ?>
									</div>
								</div>
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
									<a class="navbar__cart-link">
										<div class="navbar__cart-icon">
											<?php echo file_get_contents(get_template_directory() . '/assets/images/icon/icon-shopping-cart.svg'); ?>
										</div>
										<span class="navbar__counter-cart">
											<span class="cart-badge">
												<?php echo WC()->cart->get_cart_contents_count(); ?>
											</span>
										</span>
									</a>
								</div>
							<?php endif; ?>
							<div class="custom-mini-cart">
							<span class="close-btn">&times;</span>
								<?php woocommerce_mini_cart(); ?>
							</div>
							<div class="overlay"></div>
						</div>
					</div>
				</div>
			</div>
		</header>