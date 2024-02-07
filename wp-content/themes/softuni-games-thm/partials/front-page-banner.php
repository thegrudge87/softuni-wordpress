<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="caption header-text">
                    <h6><?php esc_html_e( get_option( 'sut_banner_main_title' ) ); ?></h6>
                    <h2><?php esc_html_e( get_option( 'sut_banner_secondary_title' ) ); ?></h2>
                    <p><?php esc_html_e( get_option( 'sut_banner_text' ) ); ?></p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="right-image">
					<?php
					$image_id = get_option( 'sut_banner_image_url' ) ?? null;
					?>
					<?php if ( $image_id && ( $image = wp_get_attachment_image( $image_id , array(410, 500) ) ) ) : ?>
						<?php echo $image; ?>
					<?php endif; ?>

                    <span class="price"><i class="fa-solid fa-heart"></i></span>
                    <span class="offer"><i class="fa-solid fa-fire"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>