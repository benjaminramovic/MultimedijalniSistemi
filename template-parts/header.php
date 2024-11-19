<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
    <body>

	<header class="header" style="background-color:<?php echo get_theme_mod( 'nav_color', '#ffff' ); ?>;">
	<?php
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
	<img id="logo" src="<?php echo $image[0]; ?>" alt="Logo" width="130">
	</a>
    
	
	<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-1',
		) );
	?>
	
	
	
  </header>