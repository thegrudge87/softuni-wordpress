<?php get_header(); ?>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php wp_title('') ?></h1>
                    <span class="breadcrumb"><a href="<?php echo get_home_url();?>"><?php _e('Home', SUT_Games::$text_domain); ?></a> <?php wp_title(); ?></span>
                </div>
            </div>
        </div>
    </div>

    <main class="contact-page section">

        <div class="container">
            <div class="row">

                <div class="col-12 text-center">
                    <div class="section-heading ">
                        <h6><?php wp_title('') ?></h6>
                        <h2>Say Hello!</h2>
                    </div>

	                <?php the_content(); ?>
                </div>
            </div>
        </div>


<?php get_footer(); ?>