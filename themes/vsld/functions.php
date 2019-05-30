<?php
/**
 * Virginia Society of Landscape Designers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Virginia_Society_of_Landscape_Designers
 */

if ( ! function_exists( 'vsld_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vsld_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Virginia Society of Landscape Designers, use a find and replace
		 * to change 'vsld' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vsld', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'vsld' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'vsld_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 287,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'vsld_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vsld_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'vsld_content_width', 640 );
}
add_action( 'after_setup_theme', 'vsld_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vsld_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'vsld' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'vsld' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'vsld_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vsld_scripts() {
	wp_enqueue_style( 'vsld-style', get_stylesheet_uri() );

	wp_enqueue_script( 'vsld-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'vsld-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vsld_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function vsld_footer_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'vsld_footer_widgets_init' );

//////////////////////////////// Nav Menu ///////////////////////////////////////
add_action('wp_enqueue_scripts', 'cssmenumaker_scripts_styles' );

function cssmenumaker_scripts_styles() {
 wp_enqueue_style( 'cssmenu-styles', get_stylesheet_directory_uri() . '/cssmenu/styles.css');
 wp_enqueue_script( 'cssmenu-js', get_stylesheet_directory_uri() . '/cssmenu/script.js');
}


class CSS_Menu_Maker_Walker extends Walker {

	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		/* Add active class */
		if(in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}

		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

//Write a function that will call the shortcode. [zipcode_radius_search]
add_shortcode('zipcode_radius_search','zipcode_radius');

//Designer Search
function zipcode_radius(){
	
	ob_start();
    ?> <form style="width:100%; padding-left:25%" action="<?php the_permalink();?>" name="zipcode-radius" method="get">
		Type 5 digit Zip Code here:<br>

		<input id="zipcode" placeholder="Zip Code" name="zipcode" type="text" style="width:60%; margin-bottom:10px;" value="<?php echo ($_GET['zipcode'] ?? '')?>"><br>
		
		*Radius &#40; miles &#41; to search:<br>

		<input id="miles" placeholder="Miles" name="miles" type="text" style="width:60%;" value="<?php echo ($_GET['miles']?? '')?>"><br>

		<input   type="submit" value="Submit" name="submit" style="border: 2px solid; border-color: #ccc #ccc #bbb; border-radius: 3px;
			background: #366734; color: white; font-size: 12px; font-size: 1rem; line-height: 1; padding: .6em 1em .4em; margin-top: 12px;">
	</form>
	

	<?php
	//function to calculate the radius
	function calculate_radius($latitude,$longitude){
		global $wpdb;
	return $wpdb->get_results($wpdb->prepare("SELECT
						old_members.*,
						zip_distance.DISTANCE
				FROM
						old_members
						LEFT JOIN (
								SELECT
										zip_code,
										(
												6371 * ACOS(
														COS(RADIANS(%s)) * COS(
																RADIANS(zipcode_data.latitude)
														) * COS(
																RADIANS(zipcode_data.longitude) - RADIANS(%s)
														) + SIN(RADIANS(%s)) * SIN(
																RADIANS(zipcode_data.latitude)
														)
												)
										) AS DISTANCE
								FROM
										zipcode_data
								HAVING
										DISTANCE <= %s
						) as zip_distance ON zip_distance.zip_code = old_members.co_zipcode
				WHERE
						zip_distance.zip_code IS NOT NULL
				ORDER BY
						zip_distance.DISTANCE ASC	", [$latitude, $longitude, $latitude, $_GET['miles']]
		));

	}


	if( isset($_GET['zipcode'])){ //the == true is not required. Won't break it but the if checks for true/false already
		global $wpdb;
		$cordinates = $wpdb->get_row($wpdb->prepare("SELECT * FROM `zipcode_data` WHERE `zip_code`= %s", $_GET['zipcode']));
		$latitude = $cordinates->latitude;
		$longitude = $cordinates->longitude;

		$results = calculate_radius($latitude,$longitude);

		?><div style="display:flex; flex-direction: column;"><?php
		foreach($results as $members){ 
		?>	
		<div style="border-bottom: 2px solid green; display: flex; justify-content: space-evenly; flex-wrap: wrap;">
			<div class="name" style="width: 33.33%; min-width: 300px;">
				<b> <?php echo("$members->firstname $members->lastname");?></b>
			</div>
			<div class="info" style="width: 33.33%; min-width: 300px;">
				<?php echo $members->company;?><br>
				<?php echo $members->co_address1;?><br>
				<?php echo $members->workphone;?><br>
			</div>
			<div class="email" style="width: 33.33%; min-width: 300px;">
				Email: <a href="<?php echo $members->email_addr1?>"><?php echo("$members->firstname $members->lastname");?></a><br>
				<a href="<?php echo $members->website_url?>">Website</a> 
			</div>	
		</div>
		<?php	}
	?></div><?php

	//Validates the zipcode input information
if (!empty($_GET['zipcode'])) {
	
	$number = $_GET['zipcode'];
	$number = filter_var($number, FILTER_VALIDATE_INT);

	if ($number === false) {
		exit('Invalid Number');
	}

}

//Validates the miles input information
if (!empty($_GET['miles'])) {
	
	$number = $_GET['miles'];
	$number = filter_var($number, FILTER_VALIDATE_INT);

	if ($number === false) {
		exit('Invalid Number');
	}

}

	}else{
	
	}

	
	return ob_get_clean();
	?>

<?php
}
