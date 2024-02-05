<?php get_header(); ?>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php wp_title( '' ) ?></h1>
                    <span class="breadcrumb"><a
                                href="<?php echo get_home_url(); ?>"><?php _e( 'Home', SUT_Games::get_text_domain() ); ?></a> <?php the_archive_title( ' » ' ); ?></span>
                </div>
            </div>
        </div>
    </div>

    <main class="contact-page section">

    <div class="container">
        <div class="row">
			<?php
			wp_reset_query();
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} else if ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}
			$games_query = array(
				'post_type'              => 'game',
				'post_status'            => 'publish',
				'posts_per_page'         => get_option( 'sut_show_games_per_page' ) ?: 6,
				'posts_per_archive_page' => get_option( 'sut_show_games_per_page' ) ?: 6,
				'paged'                  => $paged,
				'orderby'                => 'ID',
				'order'                  => 'DESC',
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false
			);

			$games = new WP_Query( $games_query );
			?>


			<?php if ( $games->have_posts() ) : ?>

				<?php while ( $games->have_posts() ) : $games->the_post(); ?>

                    <div class="col-md-6 col-lg-4 categories">
						<?php get_template_part( 'partials/list-item', 'post' ); ?>
                    </div>

				<?php endwhile; ?>

                <div class="col-12">
					<?php
					the_posts_pagination( array(
						'mid_size'  => 1,
						'prev_text' => __( '&lt;', SUT_Games::get_text_domain() ),
						'next_text' => __( '&gt;', SUT_Games::get_text_domain() ),
					) );
					?>
                </div>

			<?php else : ?>

                <div class="col-12">
                    <h2><?php _e( 'No posts were found', SUT_Games::get_text_domain() ); ?></h2>
                </div>

			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

            <div class="col-lg-6 align-self-center">

            </div>
            <div class="col-lg-6">

            </div>
        </div>
    </div>


<?php get_footer(); ?>