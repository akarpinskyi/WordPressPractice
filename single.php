<?php get_header(); the_post(); ?>

<div class="content-wrapper oh">

	<!-- Content -->
	<section class="content post-single pt-70 pt-mdm-60">
		<div class="container relative">
			<div class="row">

				<!-- post content -->
				<div class="col-md-9 post-content mb-50">

					<!-- large post -->
					<article class="entry-item large-post">

						<div class="entry-header">
							<div class="entry-category"> <?php the_category( ', ' ); ?></div>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</div>

						<div class="entry-img">
							<?php the_post_thumbnail( 'bigfeatured' ) ?>
						</div>

						<div class="entry-wrap">
							<div class="entry">

								<div class="entry-content">
									<div class="article">
										<?php the_content(); ?>
									</div>

									<!-- tags -->
									<div class="entry-tags tags mb-50 mt-40 clearfix">
										<?php the_tags( '', '' ); ?>
									</div>

									<div class="entry-meta-wrap clearfix">
										<ul class="entry-meta">
											<li class="entry-date">
												<?php the_time( 'j F Y H:i' ); ?>
											</li>
											<li class="entry-comments">
                                                <a href="<?php the_permalink() ?>#comments>"><?php comments_number() ?></a>
											</li>
										</ul>

									</div>

									<!-- entry author -->
									<div class="entry-author-box clearfix">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 100, '', '', array( 'class' => 'author-img' ) ) ?>
										<div class="author-info">
											<h6 class="author-name"><?php the_author_meta( 'display_name' ); ?></h6>
											<p class="mb-0"><?php the_author_meta( 'description' ) ?>
											</p>
											<div class="social-icons">
                                                <?php if( $instagram = get_the_author_meta( 'instagram' ) ) : ?>
													<a href="https://instagram.com/<?php echo $instagram ?>"><i class="fa fa-instagram"></i></a>
                                                <?php endif; ?>
												<?php if( $facebook = get_the_author_meta( 'facebook' ) ) : ?>
													<a href="<?php echo $facebook ?>"><i class="fa fa-facebook"></i></a>
												<?php endif; ?>
												<?php if( $twitter = get_the_author_meta( 'twitter' ) ) : ?>
													<a href="https://twitter.com/<?php echo $twitter ?>"><i class="fa fa-twitter"></i></a>
												<?php endif; ?>
												<?php if( $pinterest = get_the_author_meta( 'pinterest' ) ) : ?>
													<a href="<?php echo $pinterest ?>"><i class="fa fa-pinterest-p"></i></a>
												<?php endif; ?>
											</div>
										</div>
									</div>

                                    <?php

//                                    // получаем категории
//                                    $current_categories = get_the_category();
//                                    $category_ids = array();
//
//
//                                    foreach( $current_categories as $category ) {
//
//
//                                        $category_ids[] = $category->term_id;
//                                    }


                                    // тут можно указать post_tag (подборка постов по схожим меткам) или даже массив array('category', 'post_tag') - подборка и по меткам и по категориям
                                    $related_tax = 'category';

                                    // получаем ID всех элементов (категорий, меток или таксономий), к которым принадлежит текущий пост
                                    $cats_tags_or_taxes = wp_get_object_terms( $post->ID, $related_tax, array( 'fields' => 'ids' ) );

                                    // массив параметров для WP_Query

                                    $args = array(
                                        'posts_per_page' => 3,
                                        'ignore_sticky_posts' => true,
//                                        'category__in' => $category_ids, // array( 1, 7, 9 )
                                        'tax_query' => array(
	                                        array(
		                                        'taxonomy' => $related_tax,
		                                        'field' => 'id',
		                                        'include_children' => false, // нужно ли включать посты дочерних рубрик
		                                        'terms' => $cats_tags_or_taxes,
		                                        'operator' => 'IN' // если пост принадлежит хотя бы одной рубрике текущего поста, он будет отображаться в похожих записях, укажите значение AND и тогда похожие посты будут только те, которые принадлежат каждой рубрике текущего поста
	                                        )
                                        )
                                    );

                                        $query = new WP_Query( $args );

                                        if( $query->have_posts() ) :
                                    ?>
									<!-- related posts -->
									<div class="related-posts mt-40">
										<div class="heading-lines mb-30">
											<h3 class="heading small">Похожие материалы</h3>
										</div>
										<div class="row">

										<?php while( $query->have_posts() ) : $query->the_post(); ?>
											<div class="col-sm-4">
												<article class="entry-item">
													<div class="entry-img">
														<a href="<?php the_permalink(); ?>">
															<?php the_post_thumbnail( 'thumbnail' ) ?>
														</a>
													</div>
													<h4 class="entry-title">
														<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													</h4>
													<div class="entry-meta-wrap clearfix">
														<ul class="entry-meta">
															<li class="entry-date">
																<?php the_time( 'j F Y H:i' ) ?>
															</li>
														</ul>
													</div>
												</article>
											</div>

                                        <?php endwhile; ?>
										</div>
									</div>
								    <?php endif;

                                    wp_reset_postdata();

                                    comments_template();
                                    ?>


								</div>
							</div>
						</div>
					</article> <!-- end large post -->
				</div> <!-- end col -->

				<?php get_sidebar(); ?>

			</div> <!-- end row -->
		</div> <!-- end container -->
	</section> <!-- end content -->

<?php get_footer() ?>