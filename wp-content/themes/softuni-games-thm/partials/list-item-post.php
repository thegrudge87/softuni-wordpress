<?php ?>

<div class="item">
	<h4><?php the_title(); ?></h4>
	<div class="thumb">
		<a href="<?php the_permalink(); ?>">
            <?php if(has_post_thumbnail()): ?>
            	<?php the_post_thumbnail(array(250, 250), array('alt' => get_the_title())); ?>
            <?php else: ?>
                <img width="250" height="250"
                     class="attachment-250x250 size-250x250 wp-post-image"
                     sizes="(max-width: 250px) 100vw, 250px"
                     src="<?php bloginfo('template_url') ?>/assets/images/no-image-wide.png"
                     alt="no preview available"
                />
            <?php endif; ?>
        </a>
	</div>
</div>