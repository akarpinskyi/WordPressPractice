<!-- large post -->
<article <?php post_class( 'entry-item large-post' ) ?>>

    <div class="entry-header">
        <div class="entry-category"><?php the_category( ', ' ); ?></div>
		<h2 class="entry-title">
			<a href="<?php the_permalink() ?>"> <?php the_title() ?></a>
		</h2>
	</div>

	<?php if( has_post_thumbnail() ) : ?>
		<div class="entry-img">
		<a href="<?php the_permalink() ?>">
			<?php the_post_thumbnail( 'bigfeatured' ) ?>
		</a>
	</div>
    <?php endif; ?>

	<div class="entry-wrap">
		<div class="entry">

			<div class="entry-content">
				<?php the_excerpt() ?>
				<div class="text-center">
					<a href="<?php the_permalink() ?>" class="read-more underline-link">Читать далее</a>
				</div>
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

		</div>
	</div>
</article> <!-- end large post -->