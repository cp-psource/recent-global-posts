<?php
/*
Plugin Name: Aktuelle Netzwerkbeiträge
Plugin URI: https://n3rds.work
Description: Zeige eine anpassbare Liste der letzten Beiträge aus Deinem Multisite-Netzwerk auf Deiner Hauptseite an.
Author: WMS N@W
Version: 3.1.1
Author URI: https://github.com/cp-psource
*/

// +----------------------------------------------------------------------+
// | Copyright PSOURCE (https://github.com/cp-psource)                                |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License, version 2, as  |
// | published by the Free Software Foundation.                           |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               |
// | MA 02110-1301 USA                                                    |
// +----------------------------------------------------------------------+


if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @@@@@@@@@@@@@@@@@ PS UPDATER 1.3 @@@@@@@@@@@
 **/
require 'psource/psource-plugin-update/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
 
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/cp-psource/recent-global-posts',
	__FILE__,
	'recent-global-posts'
);
 
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

class Recent_Network_Posts {

	public function __construct() {
		add_shortcode( 'recent_network_posts', [ $this, 'render_shortcode' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 99 );
		add_action( 'init', [ $this, 'register_block' ] );
		add_action( 'admin_menu', [ $this, 'register_settings_page' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}

	public function enqueue_styles() {
		wp_register_style( 'recent-network-posts-style', false );
		wp_enqueue_style( 'recent-network-posts-style' );
		wp_add_inline_style( 'recent-network-posts-style', $this->get_inline_css() );
	}

	private function get_inline_css() {
		return <<<CSS
.network-posts {
	display: flex;
	flex-direction: column;
	gap: 2rem;
	margin: 2rem 0;
}

.network-posts.layout-grid {
	all: initial;
	display: grid !important;
	grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
	gap: 2rem !important;
}

.network-post {
	background: #fff;
	border: 1px solid #ddd;
	border-radius: 12px;
	overflow: hidden;
	display: flex;
	flex-direction: column;
	box-shadow: 0 2px 8px rgba(0,0,0,0.05);
	transition: transform 0.2s ease;
}

.network-post:hover {
	transform: translateY(-4px);
}

.network-post .thumb img {
	width: 100%;
	height: auto;
	display: block;
}

.network-post .content {
	padding: 1rem;
}

.network-post h3 {
	margin-top: 0;
	font-size: 1.2rem;
}

.network-post p {
	margin: 0.5rem 0;
	font-size: 0.95rem;
	color: #444;
}

.network-post .avatar {
	margin-top: 0.5rem;
}

.network-post .blogname {
	font-size: 0.85rem;
	color: #888;
}

.network-post .read-more {
	display: inline-block;
	margin-top: 1rem;
	font-weight: bold;
	text-decoration: none;
	color: #005f99;
}

.network-post .read-more:hover {
	text-decoration: underline;
}
CSS;
	}

	public function render_shortcode( $atts ) {
		$options = get_option( 'network_posts_defaults', [] );
		$args = shortcode_atts( array_merge( [
			'number'             => $options['number'] ?? 5,
			'posttype'           => 'post',
			'show_avatars'       => 'no',
			'avatar_size'        => 32,
			'show_blog'          => false,
			'read_more'          => '',
			'read_more_link'     => false,
			'layout'             => isset( $options['layout'] ) ? sanitize_key( $options['layout'] ) : 'card',
		], $options ), $atts );

		return $this->get_recent_posts( $args );
	}

	private function get_recent_posts( array $args ): string {
		global $wpdb;
		$sites = get_sites( [ 'public' => 1, 'archived' => 0, 'spam' => 0 ] );
		$posts = [];

		foreach ( $sites as $site ) {
			switch_to_blog( $site->blog_id );

			$q = new WP_Query([
				'post_type'      => $args['posttype'],
				'posts_per_page' => $args['number'],
				'post_status'    => 'publish',
			]);

			while ( $q->have_posts() ) {
				$q->the_post();
				$posts[] = [
					'title'   => get_the_title(),
					'url'     => get_permalink(),
					'excerpt' => get_the_excerpt(),
					'thumb'   => get_the_post_thumbnail( get_the_ID(), 'medium' ),
					'blogname'=> get_bloginfo( 'name' ),
					'author'  => get_the_author_meta( 'display_name' ),
					'avatar'  => get_avatar( get_the_author_meta('ID'), $args['avatar_size'] )
				];
			}

			wp_reset_postdata();
			restore_current_blog();
		}

		usort( $posts, function( $a, $b ) {
			return strcmp( $b['title'], $a['title'] );
		});

		$layout = preg_replace( '/[^a-z0-9_-]/i', '', $args['layout'] );
		$layout_class = 'layout-' . sanitize_html_class( sanitize_key( $args['layout'] ) );

		$html = '<div class="network-posts ' . esc_attr( $layout_class ) . '">';

		foreach ( array_slice( $posts, 0, $args['number'] ) as $post ) {
			$html .= '<div class="network-post">
				<div class="thumb">' . $post['thumb'] . '</div>
				<div class="content">
					<h3><a href="' . esc_url( $post['url'] ) . '">' . esc_html( $post['title'] ) . '</a></h3>
					<p>' . esc_html( $post['excerpt'] ) . '</p>
					<small>von ' . esc_html( $post['author'] ) . '</small>';

				if ( $args['show_avatars'] === 'yes' ) {
					$html .= '<div class="avatar">' . $post['avatar'] . '</div>';
				}

				if ( $args['show_blog'] ) {
					$html .= '<div class="blogname">' . esc_html( $post['blogname'] ) . '</div>';
				}

				if ( $args['read_more'] ) {
					$link = $args['read_more_link'] ? $post['url'] : '#';
					$html .= '<a class="read-more" href="' . esc_url( $link ) . '">' . esc_html( $args['read_more'] ) . '</a>';
				}

				$html .= '</div></div>';
		}

		$html .= '</div>';
		return $html;
	}

	public function register_block() {
		if ( function_exists( 'register_block_type' ) ) {
			register_block_type( __DIR__ . '/block' );
		}
	}

	public function register_settings_page() {
		add_options_page(
			'Netzwerkbeiträge Einstellungen',
			'Netzwerkbeiträge',
			'manage_options',
			'network-posts-settings',
			[ $this, 'render_settings_page' ]
		);
	}

	public function register_settings() {
		register_setting( 'network_posts_options', 'network_posts_defaults' );

		add_settings_section(
			'network_posts_main',
			'Standardwerte für Shortcode/Block',
			null,
			'network-posts-settings'
		);

		add_settings_field(
			'number',
			'Anzahl Beiträge',
			function() {
				$options = get_option( 'network_posts_defaults' );
				echo '<input type="number" name="network_posts_defaults[number]" value="' . esc_attr( $options['number'] ?? 5 ) . '" min="1" max="20">';
			},
			'network-posts-settings',
			'network_posts_main'
		);

		add_settings_field(
			'layout',
			'Layout',
			function() {
				$options = get_option( 'network_posts_defaults' );
				$layout = $options['layout'] ?? 'card';
				echo '<select name="network_posts_defaults[layout]">
					<option value="card"' . selected( $layout, 'card', false ) . '>Card</option>
					<option value="grid"' . selected( $layout, 'grid', false ) . '>Grid</option>
				</select>';
			},
			'network-posts-settings',
			'network_posts_main'
		);
	}

	public function render_settings_page() {
		echo '<div class="wrap"><h1>Netzwerkbeiträge – Einstellungen</h1>';
		echo '<form method="post" action="options.php">';
		settings_fields( 'network_posts_options' );
		do_settings_sections( 'network-posts-settings' );
		submit_button();
		echo '</form></div>';
	}
}
//delete_option( 'network_posts_defaults' );
new Recent_Network_Posts();
