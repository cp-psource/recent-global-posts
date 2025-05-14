<?php
function rnp_register_block() {
	register_block_type( __DIR__, [
		'render_callback' => 'rnp_render_block'
	] );
}
add_action( 'init', 'rnp_register_block' );

function rnp_render_block( $attributes ) {
	// Default-Werte setzen, wie im Shortcode
	$defaults = [
		'number'         => 5,
		'showImage'      => true,
		'imageSize'      => 'medium',
		'showAuthor'     => true,
		'showBlog'       => true,
		'readMoreText'   => 'Weiterlesen',
		'layout'         => 'card',
	];

	$args = wp_parse_args( $attributes, $defaults );

	// Mappe Block-Attribute auf Shortcode-Attribute
	$shortcode = '[recent_network_posts';
	$shortcode .= ' number="' . intval( $args['number'] ) . '"';
	$shortcode .= ' layout="' . esc_attr( $args['layout'] ) . '"';
	$shortcode .= ' show_blog="' . ( $args['showBlog'] ? 'true' : 'false' ) . '"';
	$shortcode .= ' read_more="' . esc_attr( $args['readMoreText'] ) . '"';
	$shortcode .= ' read_more_link="true"';
	$shortcode .= ' show_avatars="no"'; // Avatar hart deaktiviert
	$shortcode .= ' show_author="' . ( $args['showAuthor'] ? 'true' : 'false' ) . '"';
	$shortcode .= ' show_image="' . ( $args['showImage'] ? 'true' : 'false' ) . '"';
	$shortcode .= ' image_size="' . esc_attr( $args['imageSize'] ) . '"';
	$shortcode .= ']';

	return do_shortcode( $shortcode );
}