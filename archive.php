<?php get_header(); ?>

				<div id="content">
					<h1 id="archive">
						<?php 
						if ( is_day() )
							printf( __( 'Daily archives: <span>%s</span>' ) , get_the_date() );
						else if ( is_month() )
							printf( __( 'Monthly archives: <span>%s</span>' ) , get_the_date( 'F Y' ) );
						else if ( is_year() )
							printf( __( 'Yearly archives: <span>%s</span>' ) , get_the_date( 'Y' ) );
						else if ( is_tag() )
							printf( __( 'Tag: <span>%s</span>' ) , single_tag_title( '', false ) );
						else if ( is_category() )
							printf( __( 'Category: <span>%s</span>' ) , single_cat_title( '', false ) );
						else if ( is_author() ){
							$author = get_userdata( $_GET['author'] );
							printf( __( 'Author: <span>%s</span>' ) , $author->display_name  );
						}
						else
							_e( 'Blog archives' );
						?>
					</h1>
					<?php get_template_part('loop'); ?>
				</div><!-- #content -->
 
<?php get_sidebar(); get_footer(); ?>