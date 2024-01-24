<?php
/**
 * The header for the Theme
 *
 * @package softuni-games-thm
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	} ?>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <title><?php wp_title(); ?></title>

	<?php wp_head(); ?>


</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- ***** Preloader Start ***** -->
<!--<div id="js-preloader" class="js-preloader">-->
<!--	<div class="preloader-inner">-->
<!--		<span class="dot"></span>-->
<!--		<div class="dots">-->
<!--			<span></span>-->
<!--			<span></span>-->
<!--			<span></span>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <!-- ***** Logo Start ***** -->
					<?php echo get_custom_logo(); ?>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
					<?php
					wp_nav_menu( array(
						'menu'                 => 'primary-menu',
						'container'            => 'ul',
						'container_class'      => 'main-nav',
						'container_aria_label' => 'something',
						'theme_location'       => 'primary-menu',
						'menu_class'           => 'nav',
						'wrap_class'           => 'nav'
					) );
					?>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>

            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

