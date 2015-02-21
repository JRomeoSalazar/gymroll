				</div> <!-- end #container -->
			</div> <!-- end .inner-wrap -->
		</div> <!-- end .off-canvas-wrap -->

		<footer class="footer" role="contentinfo">
			<nav role="navigation">
				<h5 class="nav-header">Menu</h5>
				<?php joints_footer_links(); ?>
			</nav>
			<p class="source-org copyright">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. /
				<a href="<?php echo get_permalink( get_page_by_path( 'aviso-legal' ) ); ?>" title="Aviso Legal" target="_blank">Aviso Legal</a>
			</p>
		</footer> <!-- end .footer -->
						
		<!-- all js scripts are loaded in library/joints.php -->
		<?php wp_footer(); ?>
		<script type="text/javascript">
			var $dir = "<?php echo get_bloginfo('template_url') ?>/library/pdf/"
		</script>
	</body>

</html> <!-- end page -->