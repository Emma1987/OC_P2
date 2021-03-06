<?php
/*
 * The Footer Widget Area
 * @package wpre
 */
 ?>
 </div><!--.mega-container-->
 <?php if ( is_active_sidebar('wpre-footer-1') || is_active_sidebar('wpre-footer-2') || is_active_sidebar('wpre-footer-3') ) : ?>
	 <div id="footer-sidebar" class="widget-area">
	 	<div class="container">
		 	<?php 
				if ( is_active_sidebar( 'wpre-footer-1' ) ) : ?>
					<div class="footer-column col-md-4 col-sm-6"> 
						<?php dynamic_sidebar( 'wpre-footer-1'); ?> 
					</div> 
				<?php endif;
					
				if ( is_active_sidebar( 'wpre-footer-2' ) ) : ?>
					<div class="footer-column col-md-4 hidden-xs hidden-sm"> 
						<?php dynamic_sidebar( 'wpre-footer-2'); ?> 
					</div> 
				<?php endif;
		
				if ( is_active_sidebar( 'wpre-footer-3' ) ) : ?>
					<div class="footer-column col-md-4 col-sm-6"> <?php
						dynamic_sidebar( 'wpre-footer-3'); ?> 
					</div>
				<?php endif; ?>
				
	 	</div>
	 </div>	<!--#footer-sidebar-->	
<?php endif; ?>