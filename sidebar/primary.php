<?php if ( '1c' !== get_theme_mod( 'theme_layout' ) ) : // If not a one-column layout. ?>

	<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

		<?php dynamic_sidebar( EJO_Dynamic_Sidebars::get_sidebar_id() ); // Displays the primary sidebar. ?>

	</aside><!-- #sidebar-primary -->

<?php endif; // End layout check. ?>