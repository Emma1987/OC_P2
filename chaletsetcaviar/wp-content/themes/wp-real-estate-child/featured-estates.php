<?php if ( get_theme_mod('wpre_fe_enable') && is_front_page() ) : ?>
<div id="featured-estates" class="container-fluid featured-area">
	<?php if (get_theme_mod('wpre_fe_title')) : ?>
		<div class="section-title title-font container">
			<?php echo esc_html( get_theme_mod('wpre_fe_title' ) ) ?>
		</div>
	<?php endif; ?>
	    <div class="featured-posts-container">
	        <div class="fg-wrapper">
	            <?php
		            	$count = 1;
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 6, 
			        	'cat'  => esc_html( get_theme_mod('wpre_fe_cat',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        	$loop->the_post(); 
				        ?>
						<div class="fg-item-container col-md-4 col-sm-4 col-xs-6">
							<div class="fg-item">
								<a href="<?php the_permalink() ?>">
									<?php the_post_thumbnail('wpre-pop-thumb'); ?>
									<div class="product-details">
										<h3 class="title-font"><?php the_title(); ?></h3>
									</div>
								</a>
							</div>
						</div>
						<?php 
							 $count++;
							 endwhile; ?>
						<?php wp_reset_postdata(); ?>
						</div>
			</div>									
		</div>			 
</div>    

<?php endif; ?>