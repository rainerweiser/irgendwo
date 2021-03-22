<?php get_header(); ?>

<?php 
    $setting = rose_portfolio::portfolio_setting();
?>

<section class="mt-50 mb-80">
    <div class="container">

        <?php if( have_posts() ) : 

            while( have_posts()): the_post(); ?>

                <?php 
                    rose_portfolio::portfolio_heading_single();
                    rose_portfolio::portfolio_paginate(); 
                ?>

                <div class="portfolio-body">
                    <div class="row">
                    
                        <div class="<?php echo esc_attr($setting['class_content']) ?>">
                            <div class="portfolio-content">
                                <?php the_content(); ?>                                    
                            </div>
                        </div>

                        <?php if($setting['class_sidebar'] != 'no_sidebar') : ?>
                            <div class="<?php echo esc_attr($setting['class_sidebar']) ?>">
                                <div class="portfolio-info">
                                    <?php 
                                        rose_portfolio::portfolio_info(); 
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <?php rose_portfolio::rose_portfolio_related(); ?>

            <?php endwhile; ?>

        <?php endif; ?>

    </div>

</section>

<?php get_footer(); ?>
