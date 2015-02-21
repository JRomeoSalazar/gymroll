<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="row clearfix">
				
				    <div id="main" class="large-12 medium-12 columns first clearfix indice-categoria" role="main">

				    	<!-- Modificamos el loop para que muestre los post de la categoría
				    		ordenados por el custom field "numero_indice" -->
				    	<?php
					    	// args
				    		$categories = get_the_category();
				    		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$args = array(
								'category_name'		=> $categories[0]->slug,
								'posts_per_page'	=> 12,
								'meta_key'			=> 'numero_indice',
								'orderby'			=> 'meta_value_num',
								'order'				=> 'ASC',
								'paged'				=> $paged
							);

							// query
							$wp_query = new WP_Query( $args );
						?>
				
					    <!-- Título de la categoría -->
					    <h1 class="<?php echo $categories[0]->slug; ?>"><?php single_cat_title(); ?></h1>

					    <!-- Descargar catálogo completo -->


				    	<!-- Muestra todos los post de la categoría (índice) -->
					    <div class="indice row">
					    <?php
					    	/* The Loop */
					    	$i = 0;
					    	
					    	$end = "";
					    	
					    	$grid = "large-4 medium-4 columns";
					    	
					    	if (have_posts()) : while (have_posts()) : the_post();

							if ( $i >= 3 && $i % 3 == 0 ) echo "</div><div class=\"indice row\">";

							$i++;

							if ( $i == $wp_query->post_count ) $end = "end";

							get_template_part( 'partials/loop', 'category-gymroll' );
					
					    	endwhile; 
					    ?>
					    </div>	
							
							<!-- Navegación por páginas -->
					        <?php if (function_exists('joints_page_navi')) { ?>
						        <?php joints_page_navi(); ?>
					        <?php } else { ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(__('&laquo; Siguiente página', "jointstheme")) ?></li>
								        <li class="next-link"><?php previous_posts_link(__('Página anterior &raquo;', "jointstheme")) ?></li>
							        </ul>
					    	    </nav>
					        <?php } ?>
						
						<!-- Si la categoría no tiene post muestra mensaje de no encontrado -->
					    <?php else : ?>
					
    						<?php get_template_part( 'partials/content', 'missing' ); ?>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
                
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