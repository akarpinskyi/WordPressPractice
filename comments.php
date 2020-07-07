<div id="comments">
<?php if( have_comments() ) : ?>
	<!-- Comments -->
	<div class="entry-comments mt-20">
		<div class="heading-lines mb-30">
			<h3 class="heading small"><?php comments_number() ?></h3>
		</div>

		<ul class="comment-list">
			<?php
			wp_list_comments( array(
				'callback' => 'my_comment'
			) );

			?>

		</ul>
	</div> <!--  end comments -->
<?php endif; ?>

<?php if( comments_open() ) : ?>
    <!-- Leave a Comment -->
    <div id="respond" class="comment-form mt-60">
        <div class="heading-lines mb-30">
            <h3 class="heading small">Оставить комментарий</h3>
            <p><?php cancel_comment_reply_link(); ?></p>
        </div>
        <form id="form" method="post" action="<?php echo site_url( 'wp-comments-post.php' ) ?>">
            <div class="row row-16">
                <?php if( !is_user_logged_in() ) : ?>
                    <div class="col-md-4">
                        <input name="author" id="name" type="text" placeholder="Имя*">
                    </div>
                    <div class="col-md-4">
                        <input name="email" id="mail" type="email" placeholder="E-mail*">
                    </div>
                    <div class="col-md-4">
                        <input name="url" id="Website" type="text" placeholder="Сайт">
                    </div>
                <?php else: ?>
                    <p>Вы вошли как <?php $current_user = wp_get_current_user(); echo $current_user->display_name; ?>. <a href="<?php echo wp_logout_url( get_permalink() ) ?>">Выйти</a></p>
                <?php endif; ?>
                <div class="col-md-12">
                    <textarea name="comment" id="comment" placeholder="Сообщение" rows="8"></textarea>
                </div>
            </div>

            <?php comment_id_fields(); ?>
            <input type="submit" class="btn btn-lg btn-color mt-20" value="Оставить комментарий" id="submit-message">
        </form>
    </div>
<?php else : ?>
	<p>Коментарии к этой записи закрыты.</p>
<?php endif; ?>
</div>