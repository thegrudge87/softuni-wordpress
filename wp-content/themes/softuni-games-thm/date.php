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
            <div class="col-12">
                <h2 class="text-center mb-4">Below you can see all posts submitted in <?php wp_title(''); ?></h2>
            </div>
        </div>

        <div class="row">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col-md-6 col-lg-4 col-xl-3 categories">
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

                <div class="col-12 mt-3 mb-4">
                    <h5 class="text-center"><?php _e( 'No posts were found :(', SUT_Games::get_text_domain() ); ?></h5>
                </div>

			<?php endif; ?>
        </div>
    </div>


<?php get_footer(); ?>