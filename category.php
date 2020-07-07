<?php get_header(); ?>

<div class="content-wrapper oh">

	<!-- Content -->
	<section class="content blog-standard">
		<div class="container relative">
			<div class="row">

				<!-- post content -->
				<div class="col-md-9 post-content mb-50">

					<!-- category description -->
					<div class="category-description">
						<h1><?php single_cat_title() ?></h1>
						<?php echo category_description() ?>
					</div>

                    <?php if( have_posts() ) : ?>

					<!-- grid posts -->
					<div class="row items-grid">


                        <?php while( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'entry' ); ?>

					 <?php endwhile; ?>



					</div> <!-- end grid posts -->
					<?php else: ?>
                        <p>В этой рубрике пусто.</p>
					<?php endif; ?>

					<div class="row mt-20">
						<div class="col-md-12 text-center pagination">
							<?php
							    echo paginate_links( array(
							        'prev_next' => true,
                                    'prev_text' => '<i class="icon arrow_carrot-left"></i>',
								    'next_text' => '<i class="icon arrow_carrot-right"></i>',
							    ) );
							?>
<!--                            <a href="#" class=""><i class="icon arrow_carrot-left"></i></a>-->
<!--							<a href="#" class="">2</a>-->
<!--							<a href="#" class="">3</a>-->
<!--							<a href="#" class="">4</a>-->
<!--							<span class="current">5</span>-->
<!--							<span>...</span>-->
<!--							<a href="#" class="">4</a>-->
<!--							<a href="#" class=""><i class="icon arrow_carrot-right"></i></a>-->


						</div>
					</div>


				</div> <!-- end col -->

				<?php get_sidebar(); ?>

			</div> <!-- end row -->
		</div> <!-- end container -->
	</section> <!-- end content -->

<?php get_footer(); ?>