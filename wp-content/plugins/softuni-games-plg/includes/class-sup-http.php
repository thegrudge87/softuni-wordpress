<?php

namespace SUP_Games;

class SUP_Http {

	public function __construct() {

		// Add Ajax handlers
		add_action( 'wp_ajax_add_game_like', array( $this, 'game_likes_increase' ) );
		add_action( 'wp_ajax_nopriv_add_game_like', array( $this, 'game_likes_increase' ) );

		// Enqueue the ajax assets
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_ajax_scripts' ) );
		add_action( 'init', array( $this, 'set_likes_cookie' ) );
	}


	/**
	 * Set a cookie about which games were liked
	 * by the user in the last 24 hours
	 *
	 * @param $data
	 *
	 * @return void
	 */
	public function set_likes_cookie( $data = null ) {
		if ( ! isset( $_COOKIE['game_likes'] ) || $data ) {
			setcookie( 'game_likes', $data, strtotime( '+1 day' ), '/' );
		}
	}

	/**
	 * Get the cookie and return the data as array
	 *
	 * @return array|false|string[]
	 */
	public static function get_likes_cookie_data() {
		// Get the game_likes cookie, if it's not set return [];
		if ( $_COOKIE['game_likes'] ) {
			$raw_cookie = preg_replace( '/[^0-9,]/', '', $_COOKIE['game_likes'] );

			return explode( ',', $raw_cookie );
		}

		return [];
	}

	/**
	 * Handler that process the Ajax call
	 * about increasing the likes for a game by post_id
	 *
	 * @return void
	 */
	public function game_likes_increase() {

		// Guard Check that this will work only for the "add_game_like" action,
		// and we have action and post_id provided
		if ( empty( $_POST['action'] ) || $_POST['action'] != 'add_game_like' || empty( $_POST['post_id'] ) ) {
			return;
		}

		$meta_key = 'num_of_likes';
		$post_id = esc_attr( $_POST['post_id'] );
		$user_current_likes = $this->get_likes_cookie_data();

		// Check do we have the post_id in the like_cookie array
		if ( in_array( $post_id, $user_current_likes ) ) {
			wp_send_json( array(
				"status" => "already liked",
			) );
		}

		$likes_count = get_post_meta( $post_id, $meta_key, true );
		if ( empty( $likes_count ) ) {
			$likes_count = 0; // set a default value as 0 (zero);
		}

		$likes_count ++;
		update_post_meta( $post_id, $meta_key, $likes_count );

		$user_current_likes[] = $post_id;
		$this->set_likes_cookie( implode( ',', $user_current_likes ) );

		$response = array(
			"status" => "liked",
			"likes"  => $likes_count
		);

		// Return JSON response to the Ajax call
		wp_send_json( $response );
	}

	/**
	 * Enqueue the JS scripts for the Ajax Calls
	 * @return void
	 */
	public function enqueue_ajax_scripts() {

		wp_enqueue_script( 'game-likes', plugins_url( 'assets/js/game-likes.js', __DIR__ ), array( 'jquery' ), SUP_Games::get_version() );
		wp_localize_script( 'game-likes', 'game_likes', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

}