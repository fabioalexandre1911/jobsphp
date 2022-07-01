<?php get_header(); ?>

				<div id="content">
				
				<?php if ( have_posts() ):
					while( have_posts() ): the_post(); ?>
					
					<div class="post">
						<h1><a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>"><?php the_title(); ?></a></h1>

						<div class="entry-meta">
							<p><?php _e( 'Write on' ); ?>:
								<?php $mb_date = explode( '/', get_the_date( 'd/m/Y' ) ); ?>
								<a href="<?php echo get_month_link( $mb_date[2], $mb_date[1] ); ?>" title="<?php echo implode( '/', $mb_date ); ?>"><?php the_date(); ?></a> <?php _e( 'by' ); ?>
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( 'More posts from %s' ), get_the_author() ); ?>"><?php the_author(); ?></a>
								<?php comments_popup_link( __( 'Leave a comment' ), __( '1 Comment' ), __( '% Comments' ), 'comments', __( 'Comments are close.' ) ); ?>
							</p>
						</div> 

													
						<div class="entry"> 
							<?php the_content(); ?>
						</div> 
						
														
						<div class="post-utility"> 
							<p>
								<?php _e( 'Posted on' ); ?>:
								<?php
								if ( get_the_category() )
									echo get_the_category_list( ', ' );
								else
									_e( 'Without category' );
									
								echo ' | ' . __( 'Tags' );?>:
								<?php
								if ( !get_the_tags() )
									_e( 'Without tags' );
								else
									echo get_the_tag_list( '', ', ' );
								?>
							</p>
						</div> 
						
					</div><!-- .post -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>
				<?php else: ?>
					<?php get_template_part('no-results'); ?>
				<?php endif; ?>
				</div>

<?php get_sidebar(); get_footer(); ?>