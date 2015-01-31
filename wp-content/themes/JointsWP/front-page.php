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

				<div class="row front-secciones">
					<div class="large-3 medium-3 columns">
						<a href="<?php echo get_bloginfo('template_url') ?>/library/pdf/gymroll-everroll.pdf" title="GymRoll Catálogo Pavimento Everoll">
							<img src="<?php echo get_bloginfo('template_url') ?>/library/images/secciones/01-pavimento-everoll
							.jpg" alt="Pavimento Everoll" />
						</a>
					</div>
					<div class="large-3 medium-3 columns">
						<a href="<?php echo get_bloginfo('template_url') ?>/library/pdf/gymroll-ayf.pdf" title="GymRoll Catálogo Material de Sala">
							<img src="<?php echo get_bloginfo('template_url') ?>/library/images/secciones/02-material-de-sala.jpg" alt="Material de Sala" />
						</a>
					</div>
					<div class="large-3 medium-3 columns">
						<a href="#" title="GymRoll Catálogo Máquinas de Fitness">
							<img src="<?php echo get_bloginfo('template_url') ?>/library/images/secciones/03-maquinas-fitness.jpg" alt="Máquinas de Fitness" />
						</a>
					</div>
					<div class="large-3 medium-3 columns">
						<a href="#" title="GymRoll Catálogo Otro Equipamiento">
							<img src="<?php echo get_bloginfo('template_url') ?>/library/images/secciones/04-otro-equipamiento.jpg" alt="Otro Equipamiento" />
						</a>
					</div>
				</div>
	
			</div> <!-- end #content -->

<?php get_footer(); ?>