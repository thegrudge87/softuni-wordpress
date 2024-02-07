<?php

/**
 * Includes
 */
require_once 'includes/class-sut-games.php';
require_once 'includes/class-sut-settings.php';

// Initiate main theme class
$theme = new SUT_Games();


/**
 * @param $post_id
 *
 * @return void
 */
function sut_get_related_games( $post_id ) {
	if ( empty( $post_id ) ) {
		return;
	}

    // if ACF plugin is not active - do not proceed
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}

	$max_posts = get_option( 'sut_show_max_related_games' ) ?: 5;

	$related_games = get_field( 'related_games', $post_id );

	if ( ! empty( $related_games ) && is_array( $related_games ) ) {
		?>
        <div class="section categories related-games">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-heading">
                            <h6>Related</h6>
                            <h2>Related Games</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
					<?php foreach ( $related_games as $key => $related_game ) : ?>
						<?php if ( $key >= $max_posts ) {
							return;
						} ?>
                        <div class="col-lg col-sm-6 col-xs-12">
                            <div class="item">
                                <h4><?php echo $related_game->post_title; ?></h4>
                                <div class="thumb">
                                    <a href="<?php echo $related_game->guid ?>">
										<?php
										$thumbnail_url = ( has_post_thumbnail( $related_game ) )
											? get_the_post_thumbnail_url( $related_game->ID, array( 250, 250 ) )
											: bloginfo( 'template_url' ) . "/assets/images/no-image-wide.png";
										?>
                                        <img width="250" height="250"
                                             class="attachment-250x250 size-250x250 wp-post-image"
                                             sizes="(max-width: 250px) 100vw, 250px"
                                             src="<?php echo $thumbnail_url ?>"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
		<?php
	}
}