<?php
/*
** Template to Render Social Icons on Top Bar
*/

for ($i = 1; $i < 8; $i++) : 
	$social = esc_attr(get_theme_mod('wpre_social_'.$i));
	if ( ($social != 'none') && ($social != '') ) : ?>
	<a href="<?php echo esc_url( get_theme_mod('wpre_social_url'.$i) ); ?>"><i class="fa fa-fw fa-<?php echo esc_attr($social); ?>"></i></a>
	<?php endif;

endfor; ?>