<?php
/*
The comments page for joints
*/

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Por favor, no cargues esta página directamente ¡Gracias!');

  if ( post_password_required() ) { ?>
  	<div class="alert help">
    	<p class="nocomments"><?php _e("Esta entrada está protegida con contraseña. Introduce la contraseña para ver los comentarios.", "jointstheme"); ?></p>
  	</div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments" class="h2"><?php comments_number(__('<span>Sin</span> Respuestas', 'jointstheme'), __('<span>Una</span> Respuesta', 'jointstheme'), _n('<span>%</span> Respuesta', '<span>%</span> Respuestas', get_comments_number(),'jointstheme') );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=joints_comments'); ?>
	</ol>
	
  
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
	
	<!-- If comments are closed. -->
	<!--p class="nocomments"><?php _e("Los comentarios están cerrados.", "jointstheme"); ?></p-->

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">

	<h3 id="comment-form-title" class="h2"><?php comment_form_title( __('Deja una respuesta', 'jointstheme'), __('Deja una respuesta a %s', 'jointstheme' )); ?></h3>

	<div id="cancel-comment-reply">
		<p class="small"><?php cancel_comment_reply_link(); ?></p>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  	<div class="alert help">
  		<p><?php printf( __('Debes estar %1$sconectado%2$s para escribir un comentario.', 'jointstheme'), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
  	</div>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

	<p class="comments-logged-in-as"><?php _e("Conectado como", "jointstheme"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Desconectar de esta cuenta", "jointstheme"); ?>"><?php _e("Desconectar", "jointstheme"); ?> <?php _e("&raquo;", "jointstheme"); ?></a></p>

	<?php else : ?>
	
	<ul id="comment-form-elements" class="clearfix">
		
		<li>
		  <label for="author"><?php _e("Nombre", "jointstheme"); ?> <?php if ($req) _e("(required)"); ?></label>
		  <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e('Tu nombre*', 'jointstheme'); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		</li>
		
		<li>
		  <label for="email"><?php _e("Email", "jointstheme"); ?> <?php if ($req) _e("(required)"); ?></label>
		  <input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e('Tu E-Mail*', 'jointstheme'); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		  <small><?php _e("(will not be published)", "jointstheme"); ?></small>
		</li>
		
		<li>
		  <label for="url"><?php _e("Página web", "jointstheme"); ?></label>
		  <input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('¿Tienes página web?', 'jointstheme'); ?>" tabindex="3" />
		</li>
		
	</ul>

	<?php endif; ?>
	
	<p><textarea name="comment" id="comment" placeholder="<?php _e('Tu comentario aquí...', 'jointstheme'); ?>" tabindex="4"></textarea></p>
	
	<p>
	  <input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Enviar', 'jointstheme'); ?>" />
	  <?php comment_id_fields(); ?>
	</p>
	
	<?php do_action('comment_form', $post->ID); ?>
	
	</form>
	
	<?php endif; // If registration required and not logged in ?>
</section>

<?php endif; // if you delete this the sky will fall on your head ?>
