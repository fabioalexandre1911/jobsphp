<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<meta http-equiv="content-language" content="<?php bloginfo( 'language' ); ?>" />
	
		<title><?php wp_title( ' | ', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		
		<?php
		wp_enqueue_script( 'jquery' );

		if ( is_singular() && get_option( 'thread_comments' ) ){
			wp_enqueue_script( 'comment-reply' );
			wp_enqueue_script( 'validator' );
		}
		
		if ( is_search() )
			wp_enqueue_style( 'custom' );
			
		wp_head();
		?>
	</head>

	<body>
		
		<div id="page-wrap">
			
			<div id="header">
				<p><a href="<?php bloginfo( 'url' ); ?>" title="<?php esc_attr( bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
				<span><a href="<?php bloginfo( 'url' ); ?>" title="<?php esc_attr( bloginfo( 'description' ) ); ?>"><?php bloginfo( 'description' ); ?></a></span>
			</div>
			
			<div id="menu">
				<?php wp_nav_menu( array( 'location'=>'main-menu', 'container'=>null ) ); ?>
			</div>
			
			<div id="container">
