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
			<div class="nav-menu">
				<div class="navbar">
					<div class="navbar__container-wp">
						<i class="fa fa-bars" aria-hidden="true"></i>
						<div class="nav-menu__logo">
							<?php if( has_custom_logo() ): ?>
							<?php echo the_custom_logo(); ?>
							<?php endif; ?>
						</div>
						<nav class="nav-links">
							<div class="icon-close">
								<i class="fa fa-times" aria-hidden="true"></i>
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


						</div>
					</div>
				</div>
			</div>
		</header>