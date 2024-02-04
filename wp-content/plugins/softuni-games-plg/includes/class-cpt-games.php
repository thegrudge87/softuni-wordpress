<?php

namespace SUP_Games;

use WP_Post;

if ( ! class_exists( 'CPT_Games' ) ) :

	class CPT_Games {

		public function __construct() {

			// Register the CPT and taxonomies
			add_action( 'init', array( $this, 'register_games_post_type' ) );
			add_action( 'init', array( $this, 'register_game_genre_taxonomy' ) );


			// Add additional fields into the custom Game Genre taxonomy
			add_action( 'game_genre_add_form_fields', array( $this, 'game_genre_add_form_fields' ) );
			add_action( 'game_genre_edit_form_fields', array( $this, 'game_genre_edit_term_fields' ), 10, 2 );
			add_action( 'created_game_genre', array( $this, 'game_genre_save_term_fields' ) );
			add_action( 'edited_game_genre', array( $this, 'game_genre_save_term_fields' ) );

			// Add New columns for the custom field in the Custom Taxonomy
			add_filter( 'manage_edit-game_genre_columns', array( $this, 'add_game_genre_new_columns' ) );
			add_filter( 'manage_game_genre_custom_column', array( $this, 'add_game_genre_column_content' ), 10, 3 );

			/**
			 * Metaboxes
			 */
			// Register Metaboxes
			add_action( 'add_meta_boxes', array( $this, 'register_game_meta_boxes' ) );

			// Save Metabox Actions
			add_action( 'save_post_game', array( $this, 'save_game_meta' ) );
		}


		/**
		 * @return void
		 */
		public function register_games_post_type() {
			$args = [
				'label'               => esc_html__( 'Games', SUP_Games::get_text_domain() ),
				'labels'              => [
					'menu_name'          => esc_html__( 'Games', SUP_Games::get_text_domain() ),
					'name_admin_bar'     => esc_html__( 'Game', SUP_Games::get_text_domain() ),
					'add_new'            => esc_html__( 'Add Game', SUP_Games::get_text_domain() ),
					'add_new_item'       => esc_html__( 'Add New Game', SUP_Games::get_text_domain() ),
					'new_item'           => esc_html__( 'New Game', SUP_Games::get_text_domain() ),
					'edit_item'          => esc_html__( 'Edit Game', SUP_Games::get_text_domain() ),
					'view_item'          => esc_html__( 'View Game', SUP_Games::get_text_domain() ),
					'update_item'        => esc_html__( 'View Game', SUP_Games::get_text_domain() ),
					'all_items'          => esc_html__( 'All Games', SUP_Games::get_text_domain() ),
					'search_items'       => esc_html__( 'Search Games', SUP_Games::get_text_domain() ),
					'parent_item_colon'  => esc_html__( 'Parent Game', SUP_Games::get_text_domain() ),
					'not_found'          => esc_html__( 'No Games found', SUP_Games::get_text_domain() ),
					'not_found_in_trash' => esc_html__( 'No Games found in Trash', SUP_Games::get_text_domain() ),
					'name'               => esc_html__( 'Games', SUP_Games::get_text_domain() ),
					'singular_name'      => esc_html__( 'game', SUP_Games::get_text_domain() ),
				],
				'public'              => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'show_in_rest'        => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'has_archive'         => true,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite_no_front'    => false,
				'show_in_menu'        => true,
				'menu_icon'           => 'dashicons-games',
				'supports'            => [
					'title',
					'editor',
					'author',
					'thumbnail',
					'custom-fields',
					'comments',
					'revisions',
					'page-attributes',
				],
				'taxonomies'          => [
					'category',
					'post_tag',
				],
				'rewrite'             => true
			];

			register_post_type( 'game', $args );
		}

		/**
		 * Register a custom taxonomy for Games CPT
		 *
		 * @return void
		 */
		public function register_game_genre_taxonomy() {
			$labels = array(
				'name'          => __( 'Game Genres', SUP_Games::get_text_domain() ),
				'singular_name' => __( 'Game Genre', SUP_Games::get_text_domain() ),
			);

			$args = array(
				'labels'       => $labels,
				'show_in_rest' => true,
				'hierarchical' => true,
			);

			register_taxonomy( 'game_genre', 'game', $args );
		}

		/**
		 * Add new Custom Field into the custom Game Genre Taxonomy
		 *
		 * @param $taxonomy
		 *
		 * @return void
		 */
		public function game_genre_add_form_fields( $taxonomy ) {
			?>
            <div class="form-field">
                <label><?php _e( 'Image Field', SUP_Games::get_text_domain() ); ?></label>
                <a href="#" class="button sup-upload"><?php _e( 'Upload image', SUP_Games::get_text_domain() ); ?></a>
                <a href="#" class="sup-remove"
                   style="display:none"><?php _e( 'Remove image', SUP_Games::get_text_domain() ); ?></a>
                <input type="hidden" name="sup_img" value="">
            </div>
			<?php
		}

		/**
		 * Adds additional form fields for the custom meta boxes in the custom Game Genre taxonomy
		 *
		 * @param $term
		 * @param $taxonomy
		 *
		 * @return void
		 */
		public function game_genre_edit_term_fields( $term, $taxonomy ) {

			// get meta data value
			$image_id = get_term_meta( $term->term_id, 'sup_img', true );

			?>
            <tr class="form-field">
                <th>
                    <label for="sup_img">Image Field</label>
                </th>
                <td>
					<?php if ( $image = wp_get_attachment_image_url( $image_id, 'medium' ) ) : ?>
                        <a href="#" class="sup-upload">
                            <img src="<?php echo esc_url( $image ) ?>" alt=""/>
                        </a>
                        <a href="#" class="sup-remove"><?php _e( 'Remove image', SUP_Games::get_text_domain() ); ?></a>
                        <input type="hidden" name="sup_img" value="<?php echo absint( $image_id ) ?>">
					<?php else : ?>
                        <a href="#"
                           class="button sup-upload"><?php _e( 'Upload image', SUP_Games::get_text_domain() ); ?></a>
                        <a href="#" class="sup-remove"
                           style="display:none"><?php _e( 'Remove image', SUP_Games::get_text_domain() ); ?></a>
                        <input type="hidden" name="sup_img" value="">
					<?php endif; ?>
                </td>
            </tr>
			<?php
		}

		/**
		 * @param $term_id
		 *
		 * @return void
		 */
		public function game_genre_save_term_fields( $term_id ) {

			update_term_meta( $term_id, 'sup_img', absint( $_POST['sup_img'] ) );

		}

		/**
		 * Add new columns in the taxonomy list page with the
		 *
		 * @param $columns
		 *
		 * @return array
		 */
		public function add_game_genre_new_columns( $columns ): array {
			$newCol["sup_img"] = __( 'Thumbnail', SUP_Games::get_text_domain() );

			// Add the new column as first column
			return array_merge( $newCol, $columns );
		}

		/**
		 * Add a content in the new custom columns for the Game Genre Taxonomy
		 *
		 * @param $content
		 * @param $column_name
		 * @param $term_id
		 *
		 * @return mixed|string
		 */
		public function add_game_genre_column_content( $content, $column_name, $term_id ) {

			switch ( $column_name ) {
				case 'sup_img':
					$image_id = get_term_meta( $term_id, $column_name, true );
					if ( $image = wp_get_attachment_image_url( $image_id ) ) {
						$content .= '<img style="width:80px" src="' . esc_url( $image ) . '" alt=""/>';
					}
					break;
				default:
					break;
			}

			return $content;
		}

		/**
		 * Register CPT Game custom Metaboxes
		 * @return void
		 */
		public function register_game_meta_boxes() {
			add_meta_box(
				'num_of_likes',
				__( 'Number of Likes', SUP_Games::get_text_domain() ),
				array( $this, 'robots_likes_metabox_callback' ),
				'game',
				'side'
			);
		}

		/**
		 * Callback function for the "Number of likes" metabox
		 *
		 * @param WP_Post $post
		 *
		 * @return void
		 */
		public function robots_likes_metabox_callback( WP_Post $post ) {

			// Get post data if there is, or set as 0 (zero)
			$num_of_likes = get_post_meta( $post->ID, 'num_of_likes', true ) ?: 0;
			?>
            <div>
                <label for="num_of_likes"><?php _e( 'Number of Likes', SUP_Games::get_text_domain() ); ?></label>
                <input id="num_of_likes" name="num_of_likes" type="number" min="0" step="1"
                       value="<?php echo esc_attr( $num_of_likes ); ?>"/>
            </div>
			<?php
		}

		/**
		 * Save "Number of Likes" post metadata
		 *
		 * @param int|null $post_id
		 *
		 * @return void
		 */
		public function save_game_meta( ?int $post_id ) {

			// Guard check, do we have a provided $post_id
			if ( empty( $post_id ) ) {
				return;
			}

			// check do we have a number of likes, otherwise consider it as equal to 0 (zero)
			$num_of_likes = isset( $_POST['num_of_likes'] )
				? esc_attr( $_POST['num_of_likes'] )
				: 0;

			update_post_meta( $post_id, 'num_of_likes', $num_of_likes );
		}
	}

endif;