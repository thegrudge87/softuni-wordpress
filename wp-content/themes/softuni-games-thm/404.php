<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
?>

<?php get_header(); ?>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php wp_title( '' ); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <main class="section">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h2 class="text-center"><?php _e( 'Sorry, the page you are looking for was not found.', SUT_Games::get_text_domain() ); ?></h2>

                </div>
            </div>
        </div>


<?php get_footer(); ?>