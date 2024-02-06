<?php
/**
 * @package softuni-games-thm
 */

use SUP_Games\SUP_Games;

?>
<?php get_header(); ?>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php the_title() ?></h1>
                    <span class="breadcrumb"><a
                                href="<?php echo get_home_url(); ?>"><?php _e( 'Home', SUT_Games::get_text_domain() ); ?></a> <?php wp_title(); ?></span>
                </div>
            </div>
        </div>
    </div>


    <main>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
        <div class="single-product section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="left-image">
							<?php if ( has_post_thumbnail() ): ?>
								<?php the_post_thumbnail(); ?>
							<?php else: ?>
                                <img src="assets/images/single-game.jpg" alt="Cover: <?php the_title(); ?>">
							<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">

                        <h4><?php the_title(); ?></h4>

						<?php
						$likes      = get_post_meta( $post->ID, 'num_of_likes', true ) ?: 0;
						$user_likes = \SUP_Games\SUP_Http::get_likes_cookie_data();
						?>

						<?php if ( $likes > 0 ) : ?>
							<?php if ( in_array( $post->ID, $user_likes ) ): ?>
                                <span class="likes liked">
                                    <span data-likes="<?php echo $likes ?>"><?php echo $likes ?></span>
                                    <i class="fa-solid fa-heart"></i>
                                </span>
							<?php else: ?>
                                <span class="likes" data-game-id="<?php echo $post->ID; ?>">
                                    <span data-likes="<?php echo $likes ?>"><?php echo $likes ?></span>
                                    <i class="fa-regular fa-heart"></i>
                                </span>
							<?php endif; ?>
						<?php else: ?>
                            <span class="likes" data-game-id="<?php echo $post->ID; ?>">
                                <span data-likes="0"></span><i class="fa-regular fa-heart"></i>
                            </span>
						<?php endif; ?>

						<?php the_excerpt(); ?>

                        <ul>
                            <li class="text-capitalize">
                                <span>Genre:</span>
								<?php

								$terms = get_terms( array(
									'taxonomy'   => 'game_genre',
									'hide_empty' => true,
								) );

								if ( $terms ) {
									$term_links = [];
									foreach ( $terms as $term ) {

										// The $term is an object, so we don't need to specify the $taxonomy.
										$term_link = get_term_link( $term );

										// If there was an error, continue to the next term.
										if ( is_wp_error( $term_link ) ) {
											continue;
										}

										// We successfully got a link. Print it out.
										$term_links[] = '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
									}

									echo implode( ", ", $term_links );

								} else {
									_e( '<em class="text-muted">No genres were selected</em>', SUP_Games::get_text_domain() );
								}

								?>
                            </li>
                            <li class="text-capitalize">
								<?php the_tags( '<span>' . __( 'Multi-tags:', SUP_Games::get_text_domain() ) . '</span>' ); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div class="sep"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="more-info">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-content">
                            <div class="row">
                                <div class="nav-wrapper ">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="description-tab"
                                                    data-bs-toggle="tab" data-bs-target="#description"
                                                    type="button" role="tab"
                                                    aria-controls="description" aria-selected="true"
                                            ><?php _e( 'Description', SUP_Games::get_text_domain() ); ?>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="reviews-tab"
                                                    data-bs-toggle="tab" data-bs-target="#reviews"
                                                    type="button" role="tab"
                                                    aria-controls="reviews" aria-selected="false"
                                            ><?php _e( 'Reviews', SUP_Games::get_text_domain() ); ?>
												<?php if ( get_comments_number( $post->ID ) ): ?>
                                                    (<?php echo get_comments_number( $post->ID ); ?>)
												<?php endif; ?>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                         aria-labelledby="description-tab">
										<?php the_content(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="reviews" role="tabpanel"
                                         aria-labelledby="reviews-tab">
										<?php if ( comments_open() || get_comments_number( $post->ID ) ) : ?>
											<?php
											$comments = get_comments( array(
												'post_id' => $post->ID,
												'status'  => 'approve'
											) );
											?>
											<?php foreach ( $comments as $comment ) : ?>
												<?php get_template_part( 'partials/comment', 'game' ) ?>
											<?php endforeach; ?>
										<?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php
		/**
		 * Load Related Games if there are any.
		 */
		if ( function_exists( 'sut_get_related_games' ) ) {
			sut_get_related_games( get_the_ID() );
		}
		?>

	<?php endwhile; ?>


<?php else : ?>

	<?php _e( 'Sorry, there is nothing I can show you.', SUT_Games::get_text_domain() ); ?>

<?php endif; ?>

<?php get_footer(); ?>