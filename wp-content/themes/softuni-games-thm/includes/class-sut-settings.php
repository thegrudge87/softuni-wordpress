<?php

class SUT_Settings {

	/**
	 * @var string
	 */
	private $main_menu_slug = 'softuni-games-options';
	private $theme_options_slug = 'sut-games-options';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'menu_page_register' ) );
		add_action( 'admin_init', array( $this, 'theme_settings_register' ) );
	}

	/**
	 * @return void
	 */
	public function menu_page_register() {

		// Add the Main Menu only if it's not registered already
		if ( empty ( $GLOBALS['admin_page_hooks'][ $this->main_menu_slug ] ) ) {
			add_menu_page(
				__( 'SoftUni Games', SUT_Games::get_text_domain() ),
				__( 'SoftUni Games', SUT_Games::get_text_domain() ),
				'manage_options',
				$this->main_menu_slug,
				array( $this, 'menu_page_content' ),
				get_theme_file_uri( '/assets/images/softuni-wizard-logo.png' ),
			);
		}

		add_submenu_page(
			$this->main_menu_slug,
			__( 'Theme Options', SUT_Games::get_text_domain() ),
			__( 'Theme Options', SUT_Games::get_text_domain() ),
			'manage_options',
			$this->theme_options_slug,
			array( $this, 'theme_sub_menu_content' )
		);
	}

	/**
	 * @return void
	 */
	public function menu_page_content() {
		?>
        <div class="wrap">
            <h2><?php _e( 'Thank you for using "SoftUni Games" products!', SUT_Games::get_text_domain() ); ?></h2>
        </div>
		<?php
	}

	public function theme_sub_menu_content() {
		?>
        <div class="wrap">
            <h1><?php _e( 'SoftUni Games Theme Options' ); ?></h1>

			<?php settings_errors(); ?>

			<?php $active_tab = $_GET['tab'] ?? 'general'; ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo $this->theme_options_slug ?>&tab=general"
                   class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
					<?php _e( 'General', SUT_Games::get_text_domain() ); ?>
                </a>
                <a href="?page=<?php echo $this->theme_options_slug ?>&tab=banner-settings"
                   class="nav-tab <?php echo $active_tab == 'banner-settings' ? 'nav-tab-active' : ''; ?>">
					<?php _e( 'Home Page Banner', SUT_Games::get_text_domain() ); ?>
                </a>
            </h2>

            <form method="post" action="options.php">
				<?php
				if ( $active_tab == 'general' ) {
					//TODO: To add the settings in the General Tab
					settings_fields( 'sut_general' );
					do_settings_sections( $this->theme_options_slug . '-general' );
				} else {
					settings_fields( 'sut_banner' );
					do_settings_sections( $this->theme_options_slug . '-banner' );
				}
				submit_button()
				?>
            </form>
        </div>
		<?php
	}

	public function theme_settings_register() {
		add_option( 'sut_banner_main_title', null );
		add_option( 'sut_banner_secondary_title', null );
		add_option( 'sut_banner_text', null );

		add_option( 'sut_show_max_related_games', 5 );

		$main_title_args = array(
			'type'              => 'string',
			'sanitize_callback' => array( $this, 'sanitize_text_field' ),
			'default'           => null,
		);
		register_setting( 'sut_banner', 'sut_banner_main_title', $main_title_args );
		register_setting( 'sut_banner', 'sut_banner_secondary_title', $main_title_args );
		register_setting( 'sut_banner', 'sut_banner_text', $main_title_args );

		$max_show_arg = array(
			'type'              => 'number',
			'sanitize_callback' => array( $this, 'sanitize_number_field' ),
			'default'           => 5
		);
		register_setting( 'sut_general', 'sut_show_max_related_games', $max_show_arg );

		/**
		 * Register General Settings section
		 */
		add_settings_section(
			'sut_general_options',
			'General Settings',
			array( $this, 'general_section_callback' ),
			$this->theme_options_slug . '-general'
		);

		/**
		 * Register the Banner Settings section
		 */
		add_settings_section(
			'sut_banner_options',
			'Banner Settings',
			array( $this, 'section_callback' ),
			$this->theme_options_slug . '-banner'
		);

		add_settings_field(
			'sut_general_max_related_field',
			__( 'Display max related Games', SUT_Games::get_text_domain() ),
			array( $this, 'sut_show_max_related_games_callback' ),
			$this->theme_options_slug . '-general',
			'sut_general_options',
			array( 'label_for' => 'sut_show_max_related_games' )
		);

		add_settings_field(
			'sut_banner_main_title_field',
			__( 'Main Banner Title', SUT_Games::get_text_domain() ),
			array( $this, 'sut_setting_banner_title_callback' ),
			$this->theme_options_slug . '-banner',
			'sut_banner_options',
			array( 'label_for' => 'sut_banner_main_title' )
		);

		add_settings_field(
			'sut_banner_secondary_title_field',
			__( 'Secondary Banner Title', SUT_Games::get_text_domain() ),
			array( $this, 'sut_banner_secondary_title_callback' ),
			$this->theme_options_slug . '-banner',
			'sut_banner_options',
			array( 'label_for' => 'sut_banner_secondary_title' )
		);

		add_settings_field(
			'sut_banner_text_field',
			__( 'Banner Text', SUT_Games::get_text_domain() ),
			array( $this, 'sut_banner_text_field_callback' ),
			$this->theme_options_slug . '-banner',
			'sut_banner_options',
			array( 'label_for' => 'sut_banner_text' )
		);
	}

	/**
	 * @param $data
	 *
	 * @return string
	 */
	public function sanitize_text_field( $data ): string {
		return esc_html( $data );
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
		_e( "<p>Configure the banner on the Home page. If the main & secondary titles are not set, the banner won't be visualized.<p>", SUT_Games::get_text_domain() );
	}

	public function section_callback( $section_passed ) {
		_e( "<p>Configure the banner on the Home page. If the main & secondary titles are not set, the banner won't be visualized.<p>", SUT_Games::get_text_domain() );
	}

	public function sut_show_max_related_games_callback(  ) {
        $max_games = get_option('sut_show_max_related_games');
		?>
        <div><input type="number" name="sut_show_max_related_games" id="sut_show_max_related_games"
                    value="<?php echo $max_games; ?>"/></div>
        <div>
            <small><em><?php _e( 'This the max number of games that will be shown in the "Related Games" sections.', SUT_Games::get_text_domain() ); ?></em></small>
        </div>
		<?php
    }

	/**
	 * Main title settings field HTML markup
	 *
	 * @return void
	 */
	public function sut_setting_banner_title_callback() {
		$banner_title = get_option( 'sut_banner_main_title' ) ?? '';
		?>
        <div><input type="text" name="sut_banner_main_title" id="sut_banner_main_title"
                    value="<?php echo $banner_title; ?>"/></div>
        <div>
            <small><em><?php _e( 'Type in what should be the <strong>main title</strong> of the Banner on the homepage', SUT_Games::get_text_domain() ); ?></em></small>
        </div>
		<?php
	}

	/**
	 * Secondary title settings field HTML markup
	 * @return void
	 */
	public function sut_banner_secondary_title_callback() {
		$banner_secondary_title = get_option( 'sut_banner_secondary_title' ) ?? '';
		?>
        <div><input type="text" name="sut_banner_secondary_title" id="sut_banner_secondary_title"
                    value="<?php echo $banner_secondary_title; ?>"/></div>
        <div>
            <small><em><?php _e( 'Type in what should be the <strong>secondary</strong> title of the Banner on the homepage', SUT_Games::get_text_domain() ); ?></em></small>
        </div>
		<?php
	}

	public function sut_banner_text_field_callback() {
		$banner_text = get_option( 'sut_banner_text' ) ?? '';
		?>
        <div>
            <textarea type="text" cols="35" rows="4"
                      name="sut_banner_text" id="sut_banner_text"
                      placeholder="<?php _e( 'Type in the paragraph text that should be visible on the homepage' ); ?>"
            ><?php esc_html_e( $banner_text ); ?></textarea>
        </div>
        <div>
            <small><em><?php _e( 'Type in the paragraph text that should be visible on the homepage', SUT_Games::get_text_domain() ); ?></em></small>
        </div>
		<?php
	}
}