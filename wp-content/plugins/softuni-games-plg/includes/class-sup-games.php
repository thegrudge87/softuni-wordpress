<?php
/**
 * @desc  General class for the SoftUni Games Plugin.
 *
 * @Class SUP_Games
 * @package softuni-games-plg
 */

namespace SUP_Games;

use SUP_Games\CPT_Games as CPT_Games;
use SUP_Games\SUP_Http as SUP_Http;

if ( ! class_exists( 'SUP_Games' ) ) :

	class SUP_Games {
		private static $text_domain = 'softuni-games-plg';
		private static $version = '1.0.0';

		public function __construct() {

			$games      = new CPT_Games();
			$shortcodes = new SUP_Shortcodes();
			$settings   = new SUP_Settings();
			$http       = new SUP_Http();

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		}

		/**
		 * @return string
		 */
		public static function get_text_domain(): string {
			return self::$text_domain;
		}

		/**
		 * @return string
		 */
		public static function get_version(): string {
			return self::$version;
		}

		public function enqueue_admin_assets() {

			// WordPress media uploader scripts
			if ( ! did_action( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}

			// our custom JS
			wp_enqueue_script(
				'sup-script-js',
				plugins_url( 'assets/js/scripts.js', __DIR__ ),
				array( 'jquery' ),
				self::get_version(),
				array(
					'strategy'  => 'defer',
					'in_footer' => 'true',
				)
			);
		}

	}

endif;