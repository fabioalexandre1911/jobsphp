
				<div id="sidebar"> 
					<ul> 
						<li>
							<?php get_search_form(); ?>
						</li> 
					</ul>
					<?php if ( !dynamic_sidebar( 'my-sidebar' ) ) : ?>
					<ul>
						<li><h3><?php _e( 'Archive' ); ?></h3></li> 
						<li>
							<ul>
								<?php wp_get_archives(); ?>
							</ul>
						</li> 
					</ul>
					<?php endif; ?>
					
				</div><!-- #sidebar -->
