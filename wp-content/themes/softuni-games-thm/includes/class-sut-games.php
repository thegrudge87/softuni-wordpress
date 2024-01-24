<?php

/**
 * @desc  General class for the Theme details.
 *
 * @Class SUT_Games
 * @package softuni-games-thm
 */
class SUT_Games {
	public static $text_domain = 'sut-games';
	public static $version = '0.1.0';

	public function __construct(){
		add_action('wp_enqueue_scripts', array($this, 'theme_assets'));
	}

	/**
	 * Load theme JS and CSS assets
	 *
	 * @param $hook
	 *
	 * @return void
	 */
	public function theme_assets($hook) {

		$args = array(
			'in_footer' => true,
			'strategy'  => 'defer',
		);

		wp_enqueue_script('sut-bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', $args );
		wp_enqueue_script('sut-isotope-js', get_template_directory_uri() . '/assets/js/isotope.min.js', null, '1.0.0', $args );
		wp_enqueue_script('sut-owl-js', get_template_directory_uri() . '/assets/js/owl-carousel.js', array('jquery'), '1.0.0', $args );
		wp_enqueue_script('sut-counter-js', get_template_directory_uri() . '/assets/js/counter.js', array('jquery'), '1.0.0', $args );
		wp_enqueue_script('sut-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', $args );

		wp_enqueue_style('sut-bootstrap-css', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', false, '1.0.0');
		wp_enqueue_style('sut-fontawesome-css', get_template_directory_uri() . '/assets/css/fontawesome.css', false, '1.0.0');
		wp_enqueue_style('sut-main-css', get_template_directory_uri() . '/assets/css/main.css', false, '1.0.0');
		wp_enqueue_style('sut-owl-css', get_template_directory_uri() . '/assets/css/owl.css', false, '1.0.0');
		wp_enqueue_style('sut-animate-css', get_template_directory_uri() . '/assets/css/animate.css', false, '1.0.0');
	}
}