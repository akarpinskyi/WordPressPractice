<?php get_header();
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = array(
	'posts_per_page' => 4,
	'post_type' => 'post',
	'paged' => $paged,
);

$the_query = new WP_Query( $args );
?>


    <div class="content-wrapper oh">

        <!-- Content -->
        <section class="content blog-standard">
            <div class="container relative">
                <div class="row">

                    <!-- post content -->
                    <div class="col-md-9 post-content mb-50">

                        <?php if( $the_query->have_posts() ) : ?>
                        <!-- grid posts -->

                        <?php
                            $count = 1;

                            while( $the_query->have_posts() ) : $the_query->the_post();
                                //is_paged() - проверяет отображается ли страница пагинации..
                                //is_sticky() - прикреплен ли большой пост..

                                if( is_sticky() ) {
	                                get_template_part( 'entry', 'large' );
                                } else {
                                    if( $count == 1 ) {
	                                    echo '<div class="row items-grid">';
                                    }
                                    get_template_part( 'entry' );
                                    $count++;
                                }

                            endwhile;
                            if( $count > 1 ) {
	                            echo '</div>';
                            }
                        ?>


                        <?php endif;
                            wp_reset_postdata();
                        ?>


                        <div class="row mt-20">
                            <div class="col-md-12 text-center pagination">
	                            <?php

                                    $big = 999999999; // need an unlikely integer

                                    echo paginate_links( array(
                                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                        'format' => '?paged=%#%',
                                        'current' => max( 1, get_query_var('paged') ),
                                        'total' => $the_query->max_num_pages,
                                        'prev_next' => true,
                                        'prev_text' => '<i class="icon arrow_carrot-left"></i>',
                                        'next_text' => '<i class="icon arrow_carrot-right"></i>',
                                    ) );
	                            ?>
                            </div>
                        </div>

                    </div> <!-- end col -->

                    <?php get_sidebar(); ?>

                </div> <!-- end row -->
            </div> <!-- end container -->
        </section> <!-- end content -->

        <?php get_footer() ?>