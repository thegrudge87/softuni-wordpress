<div class="item">
	<div class="thumb">
		<a href="<?php echo get_post_permalink(); ?>">
			<?php the_post_thumbnail( array( 260, 190 ) ); ?>
		</a>
		<?php $likes = get_post_meta( $post->ID, 'num_of_likes', true ); ?>
		<?php if ( $likes ) : ?>
			<span class="price"><?php echo $likes; ?> <i class="fa-solid fa-heart"></i></span>
		<?php endif; ?>

	</div>
	<div class="down-content">

		<?php $genres = wp_get_post_terms($post->ID, 'game_genre'); ?>
		<?php if($genres) : ?>
			<span class="category"><?php echo $genres[0]->name; ?></span>
		<?php else : ?>
			<span class="category"></span>
		<?php endif; ?>

		<h4><?php the_title(); ?></h4>
		<a href="<?php echo get_post_permalink(); ?>"><i class="fa-solid fa-gamepad"></i></a>
	</div>
</div>