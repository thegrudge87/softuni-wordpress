<?php

namespace SUP_Games;

class SUP_Settings {

	private $main_menu_slug = 'softuni-games-options';
	private $plugin_options_slug = 'sup-games-options';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'menu_page_register' ) );
	}


	public function menu_page_register() {

		// Add the Main Menu only if it's not registered already
		if ( ! menu_page_url( $this->main_menu_slug ) ) {
			add_menu_page(
				__( 'SoftUni Games', SUP_Games::get_text_domain() ),
				__( 'SoftUni Games', SUP_Games::get_text_domain() ),
				'manage_options',
				$this->main_menu_slug,
				array( $this, 'menu_page_content' ),
				plugins_url( 'softuni-games-plg/assets/images/softuni-wizard-logo.png',  ),
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
					//TODO: To add the settings in the General Tab
					// settings_fields( 'sup_general' );
					// do_settings_sections( $this->plugin_options_slug . '-general' );
				} else {
					// Add something new
				}
				submit_button()
				?>
            </form>
        </div>
		<?php
	}

}