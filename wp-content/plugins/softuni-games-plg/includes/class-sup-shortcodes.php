<?php

namespace SUP_Games;


class SUP_Shortcodes {

	public function __construct() {

		add_shortcode( 'sup_latest_games', array( $this, 'sup_latest_games' ) );
	}


	public function sup_latest_games(): string {

		$query_args = array(
			'post_type'      => 'game',
			'post_status'    => 'publish',
			'posts_per_page' => 6,
			'offset'         => 0,
			'paged'          => get_query_var( 'paged' ),
			'orderby'        => 'publish_date',
			'order'          => 'DESC',
		);

		$games = new \WP_Query( $query_args );

		if ( ! $games->have_posts() ) {
			return '';
		}

		$output = '<div class="section most-played">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>' . __( 'LATEST GAMES', SUP_Games::get_text_domain() ) . '</h6>
                        <h2>' . __( 'NEWEST ARRIVALS', SUP_Games::get_text_domain() ) . '</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="#">' . __( 'View All', SUP_Games::get_text_domain() ) . '</a>
                    </div>
                </div>';

		while ($games->have_posts() ){
			$games->the_post();

			$genres = wp_get_post_terms(get_the_ID(), 'game_genre');
			$genre = $genres ? $genres[0]->name : '';
			$output .= '<div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="'. get_post_permalink() .'">'. get_the_post_thumbnail(null, array(196, 196)) .'</a>
                        </div>
                        <div class="down-content">
                            <span class="category">'. $genre .'</span>
                            <h4>'. get_the_title() .'</h4>
                            <a href="'. get_post_permalink() .'">'. __('Explore', SUP_Games::get_text_domain()) .'</a>
                        </div>
                    </div>
                </div>';
		}
		wp_reset_postdata();

		$output .= '</div></div></div>';

		return $output;
	}

}