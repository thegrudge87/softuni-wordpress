<?php get_header(); ?>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php the_title(); ?></h1>
                    <?php get_template_part('partials/basic-breadcrumbs') ?>
                </div>
            </div>
        </div>
    </div>

    <main class="contact-page section">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if ( have_posts() ) : ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php the_content(); ?>

                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php _e( 'Sorry, there is nothing we can show you.', SUT_Games::get_text_domain() ); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>


<?php get_footer(); ?>