<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>
		<div class="wrap">

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items',
				// 'before'          => '<i>test2</i>',
				// 'after'           => '<i>test3</i>',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
			)
		); ?>

<!-- 		<ul id="menu-primary-items" class="menu-items">
			<li class="menu-stripe"></li>
			<li id="menu-item-467" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-467"><a href="http://localhost/erikjoling/home/">Home</a></li>
			<li class="menu-stripe"></li>
			<li id="menu-item-465" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-465"><a href="http://localhost/erikjoling/styleguide/">Styleguide</a>
				<ul class="sub-menu">
					<li id="menu-item-508" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-508"><a href="http://localhost/erikjoling/image-alignment-gallery/">Image alignment &#038; gallery</a></li>
				</ul>
			</li>
			<li class="menu-stripe"></li>
			<li id="menu-item-461" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-461"><a href="http://localhost/erikjoling/dit-is-een-testpagina/">Dit is een testpagina</a>
				<ul class="sub-menu">
					<li id="menu-item-462" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-462"><a href="http://localhost/erikjoling/dit-is-een-testpagina/onderliggende-testpagina-een/">Onderliggende testpagina één</a></li>
					<li id="menu-item-463" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-463"><a href="http://localhost/erikjoling/dit-is-een-testpagina/tweede-onderliggende-testpagina/">Tweede onderliggende testpagina</a></li>
					<li id="menu-item-464" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-464"><a href="http://localhost/erikjoling/dit-is-een-testpagina/onderliggende-testpagina-drie/">Onderliggende testpagina drie</a></li>
				</ul>
			</li>
			<li class="menu-stripe"></li>
			<li id="menu-item-460" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-460"><a href="http://localhost/erikjoling/contact/">Contact</a></li>
			<li class="menu-stripe"></li>
			<li id="menu-item-470" class="menu-item menu-item-type-post_type menu-item-object-page current_page_parent menu-item-470"><a href="http://localhost/erikjoling/blog/">Blog</a></li>
			<li class="menu-stripe"></li>
		</ul> -->

		</div><!-- .wrap -->
	</nav><!-- #menu-primary -->

<?php endif; // End check for menu. ?>