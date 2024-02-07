<?php

namespace SUP_Games;

if ( ! class_exists( 'SUP_Settings' ) ) :

class SUP_Settings {

	private $main_menu_slug = 'softuni-games-options';
	private $plugin_options_slug = 'sup-games-options';

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'menu_page_register' ) );
		add_action( 'admin_init', array( $this, 'register_plugin_settings' ) );

		add_filter( 'pre_get_posts', array( $this, 'number_of_games_on_archive' ) );

	}


	/**
	 * Register menu page and sub-menu pages
	 *
	 * @return void
	 */
	public function menu_page_register() {

		// Add the Main Menu only if it's not registered already
		if ( ! menu_page_url( $this->main_menu_slug ) ) {
			add_menu_page(
				__( 'SoftUni Games', SUP_Games::get_text_domain() ),
				__( 'SoftUni Games', SUP_Games::get_text_domain() ),
				'manage_options',
				$this->main_menu_slug,
				array( $this, 'menu_page_content' ),
				plugins_url( 'softuni-games-plg/assets/images/softuni-wizard-logo.png', ),
			);
		}

		// Adding Plugin Options Page
		add_submenu_page(
			$this->main_menu_slug,
			__( 'Plugin Options', SUP_Games::get_text_domain() ),
			__( 'Plugin Options', SUP_Games::get_text_domain() ),
			'manage_options',
			$this->plugin_options_slug,
			array( $this, 'plugin_sub_menu_content' )
		);

	}


	/**
	 * @return void
	 */
	public function menu_page_content() {
		?>
        <div class="wrap">
            <h2><?php _e( 'Thank you for using "SoftUni Games" products!', SUP_Games::get_text_domain() ); ?></h2>
        </div>
		<?php
	}

	/**
	 * @return void
	 */
	public function plugin_sub_menu_content() {
		?>
        <div class="wrap">
            <h1><?php _e( 'SoftUni Games Plugin Options', SUP_Games::get_text_domain() ); ?></h1>
			<?php settings_errors(); ?>

			<?php $active_tab = $_GET['tab'] ?? 'general'; ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo $this->plugin_options_slug ?>&tab=general"
                   class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
					<?php _e( 'General', SUP_Games::get_text_domain() ); ?>
                </a>
            </h2>

            <form method="post" action="options.php">
				<?php
				if ( $active_tab == 'general' ) {
					settings_fields( 'sut_general' );
					do_settings_sections( $this->plugin_options_slug . '-general' );
				} else {
					// Add something new
				}
				submit_button()
				?>
            </form>
        </div>
		<?php
	}

	/**
	 * @return void
	 */
	public function register_plugin_settings() {

		add_option( 'sut_show_max_related_games', 5 );
		add_option( 'sut_show_games_per_page', 6 );

		$max_show_arg = array(
			'type'              => 'number',
			'sanitize_callback' => array( $this, 'sanitize_number_field' ),
			'default'           => 5
		);
		register_setting( 'sut_general', 'sut_show_max_related_games', $max_show_arg );
		register_setting( 'sut_general', 'sut_show_games_per_page', $max_show_arg );


		/**
		 * Register General Settings section
		 */
		add_settings_section(
			'sut_general_options',
			'General Settings',
			array( $this, 'general_section_callback' ),
			$this->plugin_options_slug . '-general'
		);

		/**
		 * Add Settings Field for the number of related games that should be listed
		 */
		add_settings_field(
			'sut_general_max_related_field',
			__( 'Display max related Games', SUP_Games::get_text_domain() ),
			array( $this, 'sut_show_max_related_games_callback' ),
			$this->plugin_options_slug . '-general',
			'sut_general_options',
			array( 'label_for' => 'sut_show_max_related_games' )
		);

		/**
		 * Add Settings Field for the Games per page to be listed
		 */
		add_settings_field(
			'sut_show_games_per_page_field',
			__( 'Show Games Per Page', SUP_Games::get_text_domain() ),
			array( $this, 'sut_show_games_per_page_callback' ),
			$this->plugin_options_slug . '-general',
			'sut_general_options',
			array( 'label_for' => 'sut_show_games_per_page' )
		);
	}


	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function number_of_games_on_archive( $query ) {

		if ( is_post_type_archive( array( 'game' ) ) ) {
			$query->set( 'posts_per_page', get_option( 'sut_show_games_per_page' ) ?: 6 );
		}

		return $query;
	}

	/**
	 * @param $data
	 *
	 * @return int
	 */
	public function sanitize_number_field( $data ): int {
		return (int) $data;
	}

	public function general_section_callback( $section_passed ) {
		_e( "<p>Set how many items you want to be listed in different parts of the project.<p>", SUP_Games::get_text_domain() );
	}

	/**
	 * Number of related games settings field HTML markup
	 *
	 * @return void
	 */
	public function sut_show_max_related_games_callback() {
		$max_games = get_option( 'sut_show_max_related_games' );
		?>
        <div><input type="number" name="sut_show_max_related_games" id="sut_show_max_related_games"
                    value="<?php echo $max_games; ?>"/></div>
        <div>
            <small><em><?php _e( 'This the max number of games that will be shown in the "Related Games" loop.', SUP_Games::get_text_domain() ); ?></em></small>
        </div>
		<?php
	}

	/**
	 * "Games per page" settings field HTML markup
	 *
	 * @return void
	 */
	public function sut_show_games_per_page_callback() {
		$max_games = get_option( 'sut_show_games_per_page' );
		?>
        <div><input type="number" name="sut_show_games_per_page" id="sut_show_games_per_page"
                    value="<?php echo $max_games; ?>"/></div>
        <div>
            <small><em><?php _e( 'This the number of games that will be shown per page.', SUP_Games::get_text_domain() ); ?></em></small>
        </div>
		<?php
	}

}

endif;