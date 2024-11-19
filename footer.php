<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage NS_Custom_Theme
 * @since NS Custom Theme 1.0
 */
?>

		</div><!-- .site-content -->
		
	<?php if(is_active_sidebar('footer-sidebar-1') || is_active_sidebar('footer-sidebar-2') || is_active_sidebar('footer-sidebar-3') || is_active_sidebar('footer-sidebar-4') || is_active_sidebar('footer-sidebar-5')){ ?>
		<div id="footer-sidebar" class="secondary">
		<?php if(is_active_sidebar('footer-sidebar-1')){ ?>
			<div id="footer-sidebar1">
			<?php dynamic_sidebar('footer-sidebar-1'); ?>
			</div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-sidebar-2')){ ?>
			<div id="footer-sidebar2">
			<?php dynamic_sidebar('footer-sidebar-2'); ?>
			</div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-sidebar-3')){ ?>
			<div id="footer-sidebar3">
			<?php dynamic_sidebar('footer-sidebar-3'); ?>
			</div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-sidebar-4')){ ?>
			<div id="footer-sidebar4">
			<?php dynamic_sidebar('footer-sidebar-4'); ?>
			</div>
		<?php } ?>
		<?php if(is_active_sidebar('footer-sidebar-5')){ ?>
			<div id="footer-sidebar5">
			<?php dynamic_sidebar('footer-sidebar-5'); ?>
			</div>
		<?php } ?>
		</div>
	<?php } ?>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'ns_custom' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'ns_custom' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the ns_custom footer text for footer customization.
					 *
					 * @since NS Custom Theme 1.0
					 */
					 if(!has_action('ns_custom_credits')) { ?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ns_custom' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'ns_custom' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
				<?php	 } else {
						 do_action( 'ns_custom_credits' );
					 }
				?>
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
