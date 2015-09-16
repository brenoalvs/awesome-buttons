<?php
/**
 * Plugin Name:       Awesome Buttons
 * Plugin URI:        http://github.com/brenoalvs/awesome-buttons/
 * Description:       Awesome buttons for your WordPress site.
 * Version:           1.0.0
 * Author:            Breno Alves
 * Author URI:        http://brenoalvs.com.br/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       awesome-buttons
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) : die;

class Awesome_Buttons {

	public $plugin_name;
	public $plugin_version;

	private $plugin_url;
	private $plugin_path;

	public function __construct( $file ) {
		$this->plugin_name 		= 'awesome-buttons';
		$this->plugin_version 	= '1.0.0';
		$this->plugin_url 		= plugin_dir_url( $file );
		$this->plugin_path 		= plugin_dir_path( $file );

		add_shortcode( 'button', array( $this, 'add_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'awesome-buttons', $this->plugin_url . 'assets/css/awesome-buttons.css', array(), $this->plugin_version, 'all' );
		wp_enqueue_script( 'awesome-buttons', $this->plugin_url . 'assets/js/awesome-buttons.js', array(), $this->plugin_version, 'true' );
	}

	public function add_shortcode( $atts, $content = '' ) {
		$defaults = array(
			'title' 			=> __( 'Button Text', $this->plugin_name ),
			'url' 				=> '',
			'size' 				=> 'medium',
			'color' 			=> '#FFF',
			'bg-color' 			=> '#000',
			'border-color' 		=> 'transparent',
		);

		$a = shortcode_atts( $defaults, $atts );

		return '<button class="awesome-btn">'. $a['title'] .'</button>';

	}
}

$awesome_buttons = new Awesome_Buttons( __FILE__ );
