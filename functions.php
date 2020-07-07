<?php

//add_filter( 'show_admin_bar', '__return_false');

// подключаем произвольные поля
function true_custom_fields() {
	add_post_type_support( 'book', 'custom-fields'); // в качестве первого параметра укажите название типа поста
}
add_action('init', 'true_custom_fields');

// подключаем розмеры изображений
add_theme_support( 'post-thumbnails', 'post' );

add_image_size( 'bigfeatured', 888, 578,  true);
add_image_size( 'smallsidebar', 88, 69,  true);


//  подключаем свои стили к Gutenberg
add_action( 'after_setup_theme', 'my_gutenberg_css' );

function my_gutenberg_css() {

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/style-gutenberg.css' );

}

//  подключаем стили и скрипты
add_action( 'wp_enqueue_scripts', 'my_js_and_css' );

function my_js_and_css() {

	wp_enqueue_style( 'gfonts', 'http://fonts.googleapis.com/css?family=Montserrat:300,400%7COpen+Sans:400,400i,700%7CMerriweather:400ii?subset=cyrillic', array(), null );

	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '1.0' );
	wp_enqueue_style( 'font-icons', get_stylesheet_directory_uri() . '/css/font-icons.css', array(), null );
	wp_enqueue_style( 'sliders', get_stylesheet_directory_uri() . '/css/sliders.css', array(), null );
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/style.css', array(), filemtime( dirname( __FILE__ ) . '/css/style.css' ) );
	wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css', array(), null );
	wp_enqueue_style( 'spacings', get_stylesheet_directory_uri() . '/css/spacings.css', array(), null );
	wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.min.css', array(), null );

//	wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array(), null );
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', site_url() . '/wp-includes/js/jquery/jquery.js', array(), null, true );
	wp_enqueue_script( 'jquery');

	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );

	if( is_single() )
		wp_enqueue_script( 'comment-reply' );
}

//  подключаем навигационное меню
register_nav_menus ( array(
	'head_menu' => 'Меню в шапке',
//	'footer_menu' => 'Меню в футере',
) );

class My_Nav extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'dropdown-menu' );

		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		if ( in_array( 'menu-item-has-children', $classes )) {
			$classes[] = 'dropdown';
		}

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS classes applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title        Title attribute.
		 *     @type string $target       Target attribute.
		 *     @type string $rel          The rel attribute.
		 *     @type string $href         The href attribute.
		 *     @type string $aria_current The aria-current attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Включаем поле виджетов
add_action( 'widgets_init', 'mywidgets' );

function mywidgets() {
	register_sidebar(
		array(
			'id' => 'sideside',
			'name' => 'Ваш сайдбар',
			'description' => 'добавляйте сюда виджеты смело!',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<div class="heading-lines"><h3 class="widget-title heading">',
			'after_title' => '</h3></div>'
		)
	);

	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Search');


}

// включаем дополнительные инфо в контакты
function true_add_contacts( $contactmethods ) {
	$contactmethods['instagram'] = 'Акаунт в Instagram';
	$contactmethods['facebook'] = 'Ссылка на профиль в Facebook';
	$contactmethods['twitter'] = 'Акаунт в Twitter';
	$contactmethods['pinterest'] = 'Pinterest';
	return $contactmethods;
}
add_filter('user_contactmethods', 'true_add_contacts', 10, 1);


// позволяет изменить стандартный HTML коментария
function my_comment( $comment, $args, $depth ) {

//			<li>
//				<div class="comment-body">
/*					<img src="<?php echo get_stylesheet_directory_uri() ?>/img/comment_1.jpg" class="comment-avatar" alt="">*/
//					<div class="comment-content">
//						<span class="comment-author">Александр</span>
//						<span class="comment-date">20 января 2020 в 20:20</span>
//						<p>Подскажите пожалуйста, мой код не вставляется!</p>
//						<a href="#">Ответить</a>
//					</div>
//				</div>
//			</li> <!-- end 1-2 comment -->

	?><li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-body">
			<?php echo get_avatar( $comment, 70, '', '', array( 'class' => 'comment-avatar' ) ) ?>
			<div class="comment-content">
				<span class="comment-author"><?php comment_author() ?></span>
				<span class="comment-date"><?php comment_date( 'j F Y H:i ' ) ?></span>
				<?php comment_text() ?>
				<?php comment_reply_link( array_merge(
					$args,
					array(
						'depth' => $depth,
						'max_depth' => $args['max_depth']
					)
				) ); ?>
			</div>
		</div>
	<?php // без закрывающего </li>
}
