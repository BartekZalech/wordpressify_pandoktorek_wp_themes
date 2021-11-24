<?php

// function shapeSpace_include_custom_jquery()
// {

// 	wp_deregister_script('jquery');
// 	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

function wordpressify_resources()
{
	wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.4');
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', array('jquery'), 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', array('header_js', 'jquery'), 1.2, true);
	
	wp_localize_script(
		'footer_js',
		'my_ajax_object',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		)
	);
}

add_action('wp_enqueue_scripts', 'wordpressify_resources');

// Theme setup
function wordpressify_setup()
{
	// Handle Titles
	add_theme_support('title-tag');
	add_theme_support('html5');
	// Add featured image support
	add_theme_support('woocommerce');
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 255, 420);
	add_image_size('small-productThumbnail', 255, 320);

	add_image_size('gallery', 0, 320, true);
	add_image_size('square-thumbnail', 80, 80, true);
	add_image_size('banner-image', 1024, 1024, true);

	register_nav_menus(array(
		'header-menu-primary' => __('Menu główne'),
		'header-menu-footer' => __('Menu stopka')
	));
}

add_action('after_setup_theme', 'wordpressify_setup');

show_admin_bar(false);

// Add Widget Areas
function wordpressify_widgets()
{
	register_sidebar(
		array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar1',
			'before_widget' => '<div class="widget-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action('widgets_init', 'wordpressify_widgets');

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function register_acf_options_pages()
{

	if (function_exists('acf_add_options_page')) {

		// add parent

		acf_add_options_page(array(
			'page_title'     => 'Opcje',
			'menu_title'     => 'Opcje',
			'redirect'         => false
		));
	}
}

// Hook into acf initialization.
add_action('acf/init', 'register_acf_options_pages');


function primary_nav()
{
	wp_nav_menu(
		array(
			'theme_location'  => 'header-menu-primary',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'nav__primary',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}
function footer_nav()
{
	wp_nav_menu(
		array(
			'theme_location'  => 'header-menu-footer',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'nav__footer',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}

// sierotki in acf
function acf_orphans($value, $post_id, $field)
{
	if (class_exists('iworks_orphan')) {
		$orphan = new iworks_orphan();
		$value = $orphan->replace($value);
	}
	return $value;
}
add_filter('acf/format_value/type=textarea', 'acf_orphans', 10, 3);
add_filter('acf/format_value/type=wysiwyg', 'acf_orphans', 10, 3);



/**
 * Disable the emoji's
 */
function disable_wp_emojicons()
{

	// all actions related to emojis
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');

	// filter to remove TinyMCE emojis
	add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojicons_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

add_filter('emoji_svg_url', '__return_false');
