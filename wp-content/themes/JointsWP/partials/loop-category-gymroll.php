<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
	<header class="article-header">
		<h2>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php the_field('numero_indice') ?>. <?php the_title(); ?>
			</a>
		</h2>
	</header> <!-- end article header -->
					
</article> <!-- end article -->
