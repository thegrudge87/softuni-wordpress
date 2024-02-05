<?php get_header(); ?>

<?php if( get_option('sut_banner_main_title') && get_option('sut_banner_secondary_title') ): ?>
    <?php get_template_part( 'partials/front-page-banner' ); ?>
<?php endif; ?>

<?php get_template_part('partials/front-page-features') ?>

<?php get_template_part('partials/front-page-trending') ?>

<?php the_content(); ?>

<?php get_footer(); ?>