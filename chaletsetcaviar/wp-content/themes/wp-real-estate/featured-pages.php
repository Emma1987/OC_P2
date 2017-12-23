<?php if (get_theme_mod('wpre_fpages_enable') && is_front_page() ) : ?>

    <div class="featured-pages-section">
        <?php
        $pages_ids = array();
    for($i = 1; $i <= 2; $i++) :
        global $pages_ids;
        if ( get_theme_mod('wpre_fpages_page_'.$i) != 0) {
            $pages_ids[] = get_theme_mod('wpre_fpages_page_'.$i);
        }
    endfor;

        $args = array(
            'post_type' => 'page',
            'post__in' => $pages_ids,
            'orderby' => 'post__in',
        );
        $count = 0;
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) :
        global $count;
        $count++;
            $loop->the_post(); ?>
            <?php

//                    var_dump($fetured_pages); ?>

            <div class="featured-page container">
                <div class="featured-page-inner">
                    <div class="col-md-5 col-sm-5 featured-image">
                        <?php echo the_post_thumbnail('full'); ?>
                    </div>

                    <div class="col-md-7 col-sm-7 textual-info">
                        <div class="feature-title title-font"><?php the_title(); ?></div>
                        <div class="feature-content"><?php the_content(); ?>

                            <a class="feature-link title-font" href="<?php if(get_theme_mod('wpre_fpages_page_url_'.$count) !='' ) : echo get_theme_mod('wpre_fpages_page_url_'.$count); else: the_permalink(); endif; ?>"><?php _e('Learn More','wp-real-estate'); ?></a>

                    </div>
                </div>
            </div>


        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>
    </div>
<?php endif; ?>