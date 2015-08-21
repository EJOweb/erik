			</div><!-- .wrap -->
		</div><!-- #main -->

		<footer <?php hybrid_attr( 'footer' ); ?>>
			<div class="wrap">

			<?php dynamic_sidebar( 'footer' ); // Displays the primary sidebar. ?>	

			</div><!-- .wrap -->
		</footer><!-- #footer -->

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>