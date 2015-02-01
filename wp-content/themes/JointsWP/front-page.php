<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="row clearfix">
			
					<div id="main" class="large-12 medium-12 columns clearfix" role="main">
						<?php
							/* The loop */
							while ( have_posts() ) : the_post();
								if ( get_post_gallery() ) :
									$gallery = get_post_gallery( get_the_ID(), false ); // true: html ; false: array
									rv_gallery( $gallery );
								endif;
							endwhile;
						?>
					</div> <!-- end #main -->

					<div class="row slogan">
						<div class="large-12 medium-12 columns">
							<p><?php  bloginfo('description'); ?></p>
						</div>
					</div>
					
				</div> <!-- end #inner-content -->


				<!-- Secciones por categorías-->
				<?php
					/* Obtenemos los enlaces a las categorías */
					$pavimento_everoll = get_category_by_slug('pavimento-everoll');
					$pavimento_everoll_link = get_category_link($pavimento_everoll->term_id);

					$material_sala = get_category_by_slug('material-sala');
					$material_sala_link = get_category_link($material_sala->term_id);

					$maquinas_fitness = get_category_by_slug('maquinas-fitness');
					$maquinas_fitness_link = get_category_link($maquinas_fitness->term_id);

					$otro_equipamiento = get_category_by_slug('otro-equipamiento');
					$otro_equipamiento_link = get_category_link($otro_equipamiento->term_id);
				?>
				<div class="row front-secciones">
					<div class="large-3 medium-3 columns">
						<a href="<?php echo $pavimento_everoll_link; ?>" title="<?php echo $pavimento_everoll->name; ?>">
							<img src="<?php echo get_bloginfo('template_url'); ?>/library/images/secciones/01-pavimento-everoll
							.jpg" alt="Pavimento Everoll" />
						</a>
					</div>
					<div class="large-3 medium-3 columns">
						<a href="<?php echo $material_sala_link; ?>" title="<?php echo $material_sala->name; ?>">
							<img src="<?php echo get_bloginfo('template_url'); ?>/library/images/secciones/02-material-de-sala.jpg" alt="Material de Sala" />
						</a>
					</div>
					<div class="large-3 medium-3 columns">
						<a href="<?php echo $maquinas_fitness_link; ?>" title="<?php echo $maquinas_fitness->name; ?>">
							<img src="<?php echo get_bloginfo('template_url'); ?>/library/images/secciones/03-maquinas-fitness.jpg" alt="Máquinas de Fitness" />
						</a>
					</div>
					<div class="large-3 medium-3 columns">
						<a href="<?php echo $otro_equipamiento_link; ?>" title="<?php echo $otro_equipamiento->name; ?>">
							<img src="<?php echo get_bloginfo('template_url'); ?>/library/images/secciones/04-otro-equipamiento.jpg" alt="Otro Equipamiento" />
						</a>
					</div>
				</div>
	
			</div> <!-- end #content -->

<?php get_footer(); ?>