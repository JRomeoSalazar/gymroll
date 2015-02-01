<?php global $end; ?>

<div <?php post_class(array('large-4 medium-4 columns', $end)); ?>>

	<!-- Título de la sección -->
	<a href="<?php the_field('catalogo_pdf') ?><?php echo get_field('pagina') ? '#page=' . get_field('pagina') : ''; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="titulo-seccion" target="_blank">
		<?php the_title(); ?>
	</a>

	<!-- Imagen destacada de la sección -->
	<a href="<?php the_field('catalogo_pdf') ?><?php echo get_field('pagina') ? '#page=' . get_field('pagina') : ''; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank">
		<?php the_post_thumbnail('featured-indice'); ?>
	</a>

</div>
