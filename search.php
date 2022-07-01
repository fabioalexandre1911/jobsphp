<?php get_header(); ?>

				<div id="content">
					<h1 id="archive"><?php printf( __( 'Search results for: <span>%s</span>' ), get_search_query() ); ?></h1>
					<?php get_template_part('loop'); ?>
				</div><!-- #content -->
 
<?php get_sidebar(); get_footer(); ?>