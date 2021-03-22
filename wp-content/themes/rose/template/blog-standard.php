<?php
    /**
     * Template Name: Blog Standard
     */

    get_header();

?>
    <?php get_template_part('inc/heading/heading'); ?>

    <section id="main" class="mb-100">
        <div class="container">
            
            <div class="row">

                <div class="col-md-9">
                    <?php
                        if ( have_posts() )
                        {
                            while ( have_posts() )
                            {
                                the_post();
                                the_content();
                            }
                        }

                        wp_reset_query();

                        $paged = get_query_var('paged');
                        $paged = $paged ? $paged : 1;

                        $args  = array(
                            'post_type'         => 'post',
                            'posts_per_page'    => get_option('posts_per_page'),
                            'post_status'       => 'publish',
                            'paged'             => $paged
                        );

                        $aPostMeta = get_post_meta($post->ID, 'blog_layout', true);
                        if ( isset($aPostMeta['is_specify_categories']) && ( $aPostMeta['is_specify_categories'] == 'yes' ) )
                        {
                            $args['category__in'] = $aPostMeta['categories'];
                        }

                        query_posts($args);
                        get_template_part( 'inc/blog/blog-standard' );
                    ?>
                    <?php rose_blog::rose_blog_paginate(); ?>
                </div>


                <div class="col-md-3">
                    <?php get_template_part('sidebar'); ?>
                </div>

            </div>
        </div>
    </section>

<?php get_footer(); ?>