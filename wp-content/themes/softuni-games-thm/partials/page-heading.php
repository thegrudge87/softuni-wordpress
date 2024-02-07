<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
				<?php if ( is_front_page() ): ?>
                    <h1><?php esc_html_e( get_bloginfo( 'name' ) ); ?></h1>
                    <span class="breadcrumb"><?php esc_html_e( get_bloginfo( 'description' ) ); ?></span>
				<?php else: ?>
                    <h1><?php the_title(); ?></h1>
					<?php get_template_part( 'partials/basic-breadcrumbs' ) ?>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>