<?php
/**
 * @package softuni-games-thm
 */

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

    <main class="contact-page section">

    <div class="container">
        <div class="row">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

                    <div class="col-12 text-center">
                        <div class="section-heading ">
                            <h2><?php the_title(); ?></h2>
                            <div>
                                <span><?php echo get_the_author_posts_link() ?></span> |
								<?php
								$archive_year  = get_the_time( 'Y' );
								$archive_month = get_the_time( 'm' );
								$archive_day   = get_the_time( 'd' );
								?>
                                <span>
                                    <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>">
                                        <?php echo get_the_date( 'F jS, Y', $post->ID ); ?>
                                    </a>
                                </span>
                            </div>
                            <h6></h6>
                        </div>
                    </div>

                    <div class="col-12">

						<?php if ( has_post_thumbnail() ): ?>
                            <div class="row align-items-center">
                                <div class="col-md-5 col-lg-4">
									<?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                                </div>
                                <div class="col-md-7 col-md-8">
									<?php the_content(); ?>
                                </div>
                            </div>
						<?php else: ?>

							<?php the_content(); ?>

						<?php endif; ?>

                    </div>

				<?php endwhile; ?>


			<?php else : ?>

				<?php _e( 'Sorry, there is nothing I can show you.', SUT_Games::get_text_domain() ); ?>

			<?php endif; ?>
        </div>
    </div>


<?php get_footer(); ?>