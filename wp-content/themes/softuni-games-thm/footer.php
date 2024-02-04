	</main>

	<footer>
		<div class="container">
            <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="row mt-4 text-white">
                    <?php  get_sidebar( 'footer-1' ); ?>
                    <?php  get_sidebar( 'footer-2' ); ?>
                    <?php  get_sidebar( 'footer-3' ); ?>
                </div>
            <?php endif; ?>
            <div class="credits row text-center text-white text-md-start">
                <div class="col-md-6 text-md-start">
                    Copyright © 2024&nbsp;|&nbsp;<?php bloginfo('name'); ?>&nbsp
                </div>
                <div class="col-md-6 text-md-end">
                    <a class="text-white" rel="nofollow" href="https://templatemo.com" target="_blank"><?php esc_html_e('Theme Design: TemplateMo', SUT_Games::get_text_domain()); ?></a>
                </div>
            </div>
		</div>
	</footer>

	<!-- Scripts -->
	<?php wp_footer(); ?>

	</body>
</html>