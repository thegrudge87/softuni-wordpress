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

        <?php // Author Details ?>
        <section class="row mb-5">
            <div class="col-sm-4 col-lg-3 col-xl-2 text-center mb-2">
		        <?php echo get_avatar(get_the_author_meta( 'ID' ), 150, 'mystery'); ?>
            </div>
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <h1 class="text-center"><?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name') ?></h1>
                <?php if(get_the_author_meta('description')): ?>
                    <p><?php echo get_the_author_meta('description') ?></p>
                <?php else: ?>
                    <p class="fw-light fst-italic text-muted"><?php _e('The author did not add any description about himself.', SUT_Games::get_text_domain()); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <section class="row">

            <div class="col-12 text-center">
                <div class="section-heading ">
                    <h3><span class="fw-normal"><?php _e('All Posts published by this author', SUT_Games::get_text_domain()); ?></h3>
                </div>
            </div>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col-md-6 col-lg-4 categories">
						<?php get_template_part( 'partials/list-item', 'post' ); ?>
                    </div>

				<?php endwhile; ?>

                <?php // Pagination ?>
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

                <div class="col-12 text-center">
                    <h2><?php _e( 'No posts were found :(', SUT_Games::get_text_domain() ); ?></h2>
                </div>

			<?php endif; ?>

        </section>
    </div>

<?php get_footer(); ?>