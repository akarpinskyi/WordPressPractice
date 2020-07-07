<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<title><?php echo wp_get_document_title() ?></title>

	<meta charset="<?php bloginfo( 'charset' ) ?>">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">


	<!--    <link href='http://fonts.googleapis.com/css?family=Montserrat:300,400%7COpen+Sans:400,400i,700%7CMerriweather:400ii?subset=cyrillic' rel='stylesheet'>-->
	<!---->

	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/bootstrap.min.css" />-->
	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/font-icons.css" />-->
	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/sliders.css" />-->
	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/style.css" />-->
	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/responsive.css" />-->
	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/spacings.css" />-->
	<!--    <link rel="stylesheet" href="--><?php //echo get_stylesheet_directory_uri() ?><!--/css/animate.min.css" />-->
	<?php wp_head() ?>
</head>

<body class="relative">

<!-- Preloader -->
<div class="loader-mask">
	<div class="loader">
		<div></div>
		<div></div>
	</div>
</div>

<div class="main-wrapper oh">

	<header class="nav-type-1 dark-nav">
<!--		<form action="--><?php //bloginfo( 'url' ); ?><!--" method="get">-->
<!--			<input  type="text" name="s" placeholder="Поиск" value="--><?php //if(!empty($_GET['s'])){echo $_GET['s'];}?><!--"/>-->
<!--			<input type="submit" value="Найти"/>-->
<!--		</form>-->
		<!-- Fullscreen search -->
		<div class="search-wrap">
			<div class="search-inner">
				<div class="search-cell">

					<form role="search" method="get" action="<?php echo site_url() ?>">
						<div class="search-field-holder">
							<input type="text" name="s" class="form-control main-search-input" placeholder="Найти что-то..."
							       value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>">
							<div class="search-submit-icon"><i class="icon icon_search"></i></div>
							<input type="submit" class="search-submit" value="search">
						</div>
					</form>

				</div>
			</div>
			<i class="icon icon_close search-close" id="search-close"></i>
		</div> <!-- end fullscreen search -->

		<nav class="navbar navbar-fixed-top">
			<div class="navigation">
				<div class="container relative">

					<div class="row">

						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
								<span class="sr-only">Навигация</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div> <!-- end navbar-header -->


						<!-- side menu -->
						<div class="side-menu nav-left hidden-sm hidden-xs">
							<div class="nav-inner">
								<a href="#" class="logo">Мой Логотип</a>
							</div>
						</div> <!-- end side menu -->

						<div class="col-md-12 nav-wrap">
							<div class="collapse navbar-collapse text-center" id="navbar-collapse">

								<?php /*<ul class="nav navbar-nav">

                                    <li class="active">
                                        <a href="index.php">Главная</a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="index.php">Блог</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="category.html">Лайфстайл</a></li>
                                            <li><a href="category.html">Трэвел</a></li>
                                            <li><a href="category.html">Бьюти</a></li>
                                            <li><a href="category.html">Ворк хард</a></li>
                                            <li><a href="category.html">Еда</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="about.html">Обо мне</a>
                                    </li>

                                    <li>
                                        <a href="contact.html">Контакты</a>
                                    </li>

                                    <li id="mobile-search" class="hidden-lg hidden-md">
                                        <form method="get" class="mobile-search">
                                            <input type="search" class="form-control" placeholder="Search...">
                                            <button type="submit" class="search-button">
                                                <i class="icon icon_search"></i>
                                            </button>
                                        </form>
                                    </li>

                                </ul> */?> <!-- end menu -->

								<?php
								if( has_nav_menu( 'head_menu' )) {

									$mobile_search = '<li id="mobile-search" class="hidden-lg hidden-md">
                                        <form method="get" class="mobile-search" action="' . site_url() . '">
                                            <input type="search" name="s" class="form-control" placeholder="Search...">
                                            <button type="submit" class="search-button">
                                                <i class="icon icon_search"></i>
                                            </button>
                                        </form>
                                    </li>';

									wp_nav_menu( array(
										'theme_location' => 'head_menu',
										'container'      => false,
										'menu_class'     => 'nav navbar-nav',
										'items_wrap' => '<ul class="%2$s">%3$s' . $mobile_search . '</ul>',
										'depth' => 2,
										'walker' => new My_Nav(),

									) );
								}
								?>

							</div> <!-- end collapse -->
						</div> <!-- end col -->

						<!-- side menu -->
						<div class="side-menu right mobile-left-align">
							<div class="nav-inner">
								<div class="nav-search-wrap hidden-sm hidden-xs right">
									<a href="#" class="nav-search search-trigger">
										<i class="icon icon_search"></i>
									</a>
								</div>
							</div>
						</div> <!-- end side menu -->

					</div> <!-- end row -->
				</div> <!-- end container -->
			</div> <!-- end navigation -->
		</nav> <!-- end navbar -->
	</header>