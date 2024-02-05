<?php
$trending_query_args = array(
	'post_type'      => 'game',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
	'offset'         => 0,
	'paged'          => get_query_var( 'paged' ),
	'orderby'        => 'ID',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key'      => 'is_trending',
			'value'    => 1,
			'compare'  => '=',
		)
	)
);

$trending_posts = new WP_Query( $trending_query_args );
?>

<?php if ( $trending_posts->have_posts() ) : ?>


    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6><?php esc_html_e( 'Trending', SUT_Games::get_text_domain() ); ?></h6>
                        <h2><?php esc_html_e( 'Trending Games', SUT_Games::get_text_domain() ); ?></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="<?php echo get_post_type_archive_link( 'game' ) ?>">View All</a>
                    </div>
                </div>
            </div>

            <div class="row">

				<?php while ( $trending_posts->have_posts() ) : $trending_posts->the_post(); ?>

                    <div class="col-lg-3 col-md-6">
						<?php get_template_part( 'partials/list-item-with-actions', 'game' ) ?>
                    </div>

				<?php endwhile; ?>

            </div>

        </div>
    </div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
