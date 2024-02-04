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
		add_menu_page(
			__( 'SoftUni Games', SUT_Games::get_text_domain() ),
			__( 'SoftUni Games', SUT_Games::get_text_domain() ),
			'manage_options',
			$this->main_menu_slug,
			array( $this, 'menu_page_content' )
		);
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
					echo 'general';
                    //TODO: To add the settings in the General Tab
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

		$main_title_args = array(
			'type'              => 'string',
			'sanitize_callback' => array( $this, 'sanitize_text_field' ),
			'default'           => null,
		);
		register_setting( 'sut_banner', 'sut_banner_main_title', $main_title_args );
		register_setting( 'sut_banner', 'sut_banner_secondary_title', $main_title_args );
		register_setting( 'sut_banner', 'sut_banner_text', $main_title_args );


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

	public function sanitize_text_field( $data ): string {
		return esc_html( $data );
	}

	public function section_callback( $section_passed ) {
        _e("<p>Configure the banner on the Home page. If the main & secondary titles are not set, the banner won't be visualized.<p>", SUT_Games::get_text_domain());
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