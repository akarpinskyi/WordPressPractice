<?php
/*
 *  Template name: Страница контактов
 */
get_header();
the_post();
?>

<div class="content-wrapper oh">

    <!-- Content -->
    <section class="section-wrap contact pt-mdm-60">
        <div class="container relative">
            <div class="text-center">
                <h1 class="heading underline-title uppercase">Контакты</h1>
            </div>
            <div class="row">

                <div class="col-sm-10 col-sm-offset-1">
                    <?php the_content() ?>

                    <!-- contact form -->
                    <div class="contact-form mt-30">
                        <form id="contact-form" action="<?php echo get_stylesheet_directory_uri() ?>/send.php" method="POST">

	                        <?php if( isset( $_GET['status'] ) && 'success' == $_GET['status'] ) : ?>
                                <p class="message success">Ваше сообщение успешно отправлено.</p>
	                        <?php endif ?>

                            <?php if( isset( $_GET['status'] ) && 'error' == $_GET['status'] ) : ?>
                                <p class="message error">Заполните, пожалуйста, все поля.</p>
                            <?php endif ?>

	                        <?php if( isset( $_GET['status'] ) && 'error-2' == $_GET['status'] ) : ?>
                                <p class="message error">Что-то пошло не так.</p>
	                        <?php endif ?>

                            <div class="row row-16">
                                <div class="col-md-4">
                                    <input name="name" id="name" type="text" placeholder="Имя*">
                                </div>
                                <div class="col-md-4">
                                    <input name="mail" id="mail" type="email" placeholder="E-mail*">
                                </div>
                                <div class="col-md-4">
                                    <input name="subject" id="subject" type="text" placeholder="Тема">
                                </div>
                                <textarea name="comment1"></textarea>
                                <textarea name="comment2"></textarea>
                                <div class="col-md-12">
                                    <textarea name="message" id="comment" placeholder="Сообщение" rows="8"></textarea>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-lg btn-color mt-20" value="Отправить" id="submit-message">
                            <div id="msg" class="message"></div>
                        </form>
                    </div>

                </div>
            </div> <!-- end row -->

        </div> <!-- end container -->
    </section> <!-- end content -->

<?php get_footer(); ?>