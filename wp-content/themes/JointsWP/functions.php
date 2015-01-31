<?php
ob_start();
/*
This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/* Página de ajustes de mi tema */

/*
 * Función para crear los menús de páginas de ajustes
 */
add_action("admin_menu", "setup_rv_admin_menus");
function setup_rv_admin_menus() {
	add_menu_page('Ajustes del tema', 'Tema Gymroll', 'manage_options', 
		'rv_settings', null, 'dashicons-welcome-widgets-menus', 6);
	add_submenu_page('rv_settings', 'Elementos de la página de Inicio', 'Página de Inicio',
		'manage_options', 'rv_settings', 'rv_front_page_settings');
}

/*
 * Función para crear las página de ajustes de la front page
 */

function rv_front_page_settings() {

	// Si nos llegan datos por POST los salvamos
	if (isset($_POST["update_settings"])) {
		// if this fails, check_admin_referer() will automatically print a "failed" page and die.
		if ( ! empty( $_POST ) && check_admin_referer( 'update_settings', 'rv_nonce_update_settings' ) ) {

			// Actualizamos los ajustes de apariencia
		    /*$num_sticky_posts = esc_attr($_POST["num_sticky_posts"]);
			update_option("rv_num_sticky_posts", $num_sticky_posts);*/

			// Actualizamos los campos de contacto
			foreach ($_POST["contacto"] as $key => $value) {
				$contacto[$key] = esc_attr($value);
			}
			update_option("rv_contacto", $contacto);
		}

	}
	else {
		/*$num_sticky_posts = get_option('rv_num_sticky_posts');*/
		$contacto = get_option('rv_contacto');

		if ( !isset($contacto['twitter']) ) $contacto['twitter'] = '';
		if ( !isset($contacto['facebook']) ) $contacto['facebook'] = '';
		if ( !isset($contacto['googleplus']) ) $contacto['googleplus'] = '';
		if ( !isset($contacto['email']) ) $contacto['email'] = '';
		if ( !isset($contacto['telefono']) ) $contacto['telefono'] = '';
		if ( !isset($contacto['direccion']) ) $contacto['direccion'] = '';
	}

	?>

	<!-- Generamos el código de nuestra página de ajustes con sus campos de formulario -->
	<div class="wrap">
		<h2>Elementos de la página de Inicio</h2>

		<?php 
			if (isset($_POST["update_settings"]))
				echo "<div id=\"message\" class=\"updated below-h2\"><p>Ajustes actualizados</p></div>";
		?>
		<br class="clear">
		<div id="col-container">
			<div id="col-left">
				<div class="col-wrap">
					<div class="form-wrap">
						<form method="POST" action="">
							
							<h3>Apariencia</h3>

							<input type="hidden" name="update_settings" value="1" />
							<?php wp_nonce_field('update_settings','rv_nonce_update_settings'); ?>

							<!--<div class="form-field">
								<label for="num_sticky_posts">Número de destadados:</label> 
								<input id="num_sticky_posts" name="num_sticky_posts" type="number" value="<?php echo $num_sticky_posts; ?>" size="40" />
								<p>Número de entradas destacadas a mostrar en el inicio</p>
							</div>-->
							
							<h3>Contacto</h3>

							<div class="form-field">
								<label for="contacto_twitter">Twitter:</label> 
								<input id="contacto_twitter" name="contacto[twitter]" type="text" value="<?php echo $contacto['twitter']; ?>" size="40" />
								<p>Dirección de Twitter que se mostrará en la página</p>
							</div>

							<div class="form-field">
								<label for="contacto_facebook">Facebook:</label> 
								<input id="contacto_facebook" name="contacto[facebook]" type="text" value="<?php echo $contacto['facebook']; ?>" size="40" />
								<p>Dirección de Facebook que se mostrará en la página</p>
							</div>

							<div class="form-field">
								<label for="contacto_googleplus">Google Plus:</label> 
								<input id="contacto_googleplus" name="contacto[googleplus]" type="text" value="<?php echo $contacto['googleplus']; ?>" size="40" />
								<p>Dirección de Google Plus que se mostrará en la página</p>
							</div>

							<div class="form-field">
								<label for="contacto_email">Email de contacto:</label> 
								<input id="contacto_email" name="contacto[email]" type="text" value="<?php echo $contacto['email']; ?>" size="40" />
								<p>Dirección de correo electrónico que se mostrará en la página</p>
							</div>

							<div class="form-field">
								<label for="contacto_telefono">Teléfono:</label> 
								<input id="contacto_telefono" name="contacto[telefono]" type="text" value="<?php echo $contacto['telefono']; ?>" size="40" />
								<p>Teléfono que se mostrará en la página</p>
							</div>

							<div class="form-field">
								<label for="contacto_direccion">Dirección:</label> 
								<input id="contacto_direccion" name="contacto[direccion]" type="text" value="<?php echo $contacto['direccion']; ?>" size="40" />
								<p>Dirección de la empresa que se mostrará en la página</p>
							</div>

							<p class="submit">
								<input type="submit" name="submit" id="submit" class="button button-primary" value="Actualizar ajustes">	
							</p>
						</form>
					</div><!-- ./form-wrap -->
				</div><!-- ./col-wrap -->
			</div><!-- ./col-left -->
		</div><!-- ./col-container -->
	</div><!-- ./wrap -->

	<?php
}

/* Front Page Orbit Slider Image Gallery */
function rv_gallery( $gallery ) {
	// Obtenemos los 'id' de las imágenes
	$attachments = explode(",", $gallery['ids']);

	if (empty($attachments)) return '';

	// Here's your actual output, you may customize it to your need
	$output = "<div class=\"slideshow-wrapper\">\n";
	$output .= "<div class=\"preloader\"></div>\n";
	$output .= "<ul data-orbit data-options=\"slide_number:false\">\n";

	// Now you loop through each attachment
	foreach ( $attachments as $attachment ) {
		// Fetch all data related to attachment 
		$img = wp_prepare_attachment_for_js( $attachment );

		// If you want a different size change 'full', or 'large' to eg. 'medium'
		$url = $img['sizes']['full']['url'];
		$height = $img['sizes']['full']['height'];
		$width = $img['sizes']['full']['width'];
		$alt = $img['alt'];

		// Store the caption
		$caption = $img['caption'];

		$output .= "<li>\n";
		$output .= "<img src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" alt=\"{$alt}\" />\n";

		// Output the caption if it exists
		if ($caption) { 
			$output .= "<div class=\"orbit-caption\"><p>{$caption}</p></div>\n";
		}
		$output .= "</li>\n";
	}

	$output .= "</ul>\n";
	$output .= "</div>\n";

	echo $output;

}

/* Blueimp Gallery */
add_filter('post_gallery', 'blueimp_gallery', 10, 2);
function blueimp_gallery($output, $attr) {
	global $post;

	if (isset($attr['orderby'])) {
	    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
	    if (!$attr['orderby'])
	        unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
	    'order' => 'ASC',
	    'orderby' => 'menu_order ID',
	    'id' => $post->ID,
	    'itemtag' => 'dl',
	    'icontag' => 'dt',
	    'captiontag' => 'dd',
	    'columns' => 3,
	    'size' => 'thumbnail',
	    'include' => '',
	    'exclude' => ''
	), $attr));

	$id = intval($id);
	if ('RAND' == $order) $orderby = 'none';

	if (!empty($include)) {
	    $include = preg_replace('/[^0-9,]+/', '', $include);
	    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

	    $attachments = array();
	    foreach ($_attachments as $key => $val) {
	        $attachments[$val->ID] = $_attachments[$key];
	    }
	}

	if (empty($attachments)) return '';

	// Here's your actual output, you may customize it to your need
	$output = "<div class=\"radius panel\">\n<div id=\"blueimp-links\">\n";

	// Now you loop through each attachment
	foreach ($attachments as $id => $attachment) {
	    // Fetch all data related to attachment 
	    $img = wp_prepare_attachment_for_js($id);

	    // If you want a different size change 'large' to eg. 'medium'
	    $thumbnail = $img['sizes']['thumbnail']['url'];
	    $full = $img['sizes']['full']['url'];
	    $height = $img['sizes']['thumbnail']['height'];
	    $width = $img['sizes']['thumbnail']['width'];
	    $alt = $img['alt'];

	    $output .= "<a href=\"{$full}\" title=\"{$alt}\">\n";
	    $output .= "<img src=\"{$thumbnail}\" width=\"{$width}\" height=\"{$height}\" alt=\"{$alt}\" />\n";
	    $output .= "</a>\n";
	}

	$output .= "</div>\n</div>\n";

	return $output;
}

/* Función para que las categorías de Gymroll cojan la plantilla deseada */
add_filter( 'category_template', 'gr_category_template' );
function gr_category_template( $template ) {
	$categories = array("pavimento-everoll", "material-sala", "maquinas-fitness", "otro-equipamiento");
	if( is_category( $categories ) ) {
		$template = locate_template( array( 'category-gymroll.php', 'archive.php' ) );
	}
	
	return $template;
}

/*********************
INCLUDE NEEDED FILES
*********************/

/*
library/joints.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once(get_template_directory().'/library/joints.php'); // if you remove this, Joints will break
/*
library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once(get_template_directory().'/library/custom-post-type-accordion.php'); // you can disable this if you like
require_once(get_template_directory().'/library/custom-post-type.php'); // you can disable this if you like
/*
library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once(get_template_directory().'/library/admin.php'); // this comes turned off by default
/*
library/translation/translation.php
	- adding support for other languages
*/
// require_once(get_template_directory().'/library/translation/translation.php'); // this comes turned off by default

/*********************
MENUS & NAVIGATION
*********************/
// registering wp3+ menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu' ),   // main nav in header
		'footer-links' => __( 'Footer Links' ) // secondary nav in footer
	)
);

// the main menu
function joints_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'jointstheme' ),  // nav name
    	'menu_class' => '',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
    	'fallback_cb' => 'joints_main_nav_fallback'      // fallback function
	));
} /* end joints main nav */

// the footer menu (should you choose to use one)
function joints_footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	//'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'jointstheme' ),   // nav name
    	'menu_class' => 'no-bullet',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'joints_footer_links_fallback'  // fallback function
	));
} /* end joints footer link */

// this is the fallback for header menu
function joints_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => '',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function joints_footer_links_fallback() {
	/* you can put a default here if you like */
}

/*********************
SIDEBARS
*********************/

// Sidebars & Widgetizes Areas
function joints_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'jointstheme'),
		'description' => __('The first (primary) sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'offcanvas',
		'name' => __('Offcanvas', 'jointstheme'),
		'description' => __('The offcanvas sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'jointstheme'),
		'description' => __('The second (secondary) sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/*********************
COMMENT LAYOUT
*********************/

// Comment Layout
function joints_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('panel'); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix large-12 columns">
			<header class="comment-author">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<?php printf(__('<cite class="fn">%s</cite>', 'jointstheme'), get_comment_author_link()) ?> on
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__(' F jS, Y - g:ia', 'jointstheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'jointstheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e('Your comment is awaiting moderation.', 'jointstheme') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

?>