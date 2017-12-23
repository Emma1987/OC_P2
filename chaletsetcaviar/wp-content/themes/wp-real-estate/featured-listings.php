<?php if ( get_theme_mod('wpre_fn_enable') && is_front_page() ) : ?>
<div id="featured-news" class="container featured-area">
	
	<div class="col-md-12">
	<?php if (get_theme_mod('wpre_fn_title')) : ?>
		<div class="section-title title-font">
			<?php echo esc_html( get_theme_mod('wpre_fn_title' ) ) ?>
		</div>
	<?php endif; ?>
	    <div class="featured-news-container">
	        <div class="fg-wrapper">
	            <?php
		            	$count = 1;
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 4, 
			        	'cat'  => esc_html( get_theme_mod('wpre_fn_cat',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        	$loop->the_post(); 
				        ?>
						<div class="fg-item-container col-md-3 col-sm-3 col-xs-12">
							<div class="fg-item">
								<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
									<?php the_post_thumbnail('wpre-sq-thumb'); ?>
									
									<div class="product-details">
										<h3><?php the_title(); ?></h3>
										<?php if ( function_exists('property_post_meta') ) : 
											property_post_meta( 'archive-layout' );	
										endif; ?>

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