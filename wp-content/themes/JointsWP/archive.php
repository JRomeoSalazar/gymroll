<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="row clearfix">
				
				    <div id="main" class="large-8 medium-8 columns first clearfix" role="main">
				
					    <?php if (is_category()) { ?>
						    <h1>
							    <span><?php _e("Tema:", "jointstheme"); ?></span> <?php single_cat_title(); ?>
					    	</h1>
					    
					    <?php } elseif (is_tag()) { ?> 
						    <h1>
							    <span><?php _e("Etiquetado:", "jointstheme"); ?></span> <?php single_tag_title(); ?>
						    </h1>
					    
					    <?php } elseif (is_author()) { 
					    	global $post;
					    	$author_id = $post->post_author;
					    ?>
						    <h1>

						    	<span><?php _e("Entradas por:", "jointstheme"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>

						    </h1>
					    <?php } elseif (is_day()) { ?>
						    <h1>
	    						<span><?php _e("Archivo diario:", "jointstheme"); ?></span> <?php the_time('l, F j, Y'); ?>
						    </h1>
		
		    			<?php } elseif (is_month()) { ?>
			    		    <h1>
				    	    	<span><?php _e("Archivo mensual:", "jointstheme"); ?></span> <?php the_time('F Y'); ?>
					        </h1>
					
					    <?php } elseif (is_year()) { ?>
					        <h1>
					    	    <span><?php _e("Archivo anual:", "jointstheme"); ?></span> <?php the_time('Y'); ?>
					        </h1>
					    <?php } ?>

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    	<?php get_template_part( 'partials/loop', 'archive' ); ?>
					
					    <?php endwhile; ?>		
					
					        <?php if (function_exists('joints_page_navi')) { ?>
						        <?php joints_page_navi(); ?>
					        <?php } else { ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(__('&laquo; Entradas más antiguas', "jointstheme")) ?></li>
								        <li class="next-link"><?php previous_posts_link(__('Entradas más recientes &raquo;', "jointstheme")) ?></li>
							        </ul>
					    	    </nav>
					        <?php } ?>
					
					    <?php else : ?>
					
    						<?php get_template_part( 'partials/content', 'missing' ); ?>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
	    			<?php get_sidebar(); ?>
                
                </div> <!-- end #inner-content -->
                
			</div> <!-- end #content -->

			<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
			<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
			    <div class="slides"></div>
			    <h3 class="title"></h3>
			    <a class="prev">‹</a>
			    <a class="next">›</a>
			    <a class="close">×</a>
			    <a class="play-pause"></a>
			    <ol class="indicator"></ol>
			</div>

<?php get_footer(); ?>