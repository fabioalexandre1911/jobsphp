<?php
register_nav_menu( 'main-menu', __('Main Menu') );

register_sidebar( array(
	'name'          => __( 'My Sidebar' ),
	'id'            => 'my-sidebar',
	'before_widget' => '<ul><li>',
	'after_widget'  => '</li></ul>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>')
);

load_theme_textdomain( 'default', TEMPLATEPATH.'/lang' );

wp_register_script( 'validator', get_bloginfo( 'template_directory') . '/js/validator.js', array( 'jquery' ), '1.0' );

wp_register_style( 'custom', get_bloginfo( 'template_directory') . '/css/custom.css' );
?>