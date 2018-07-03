<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tr_theme2
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="container footer-container">
            <div class="site-info d-flex flex-row flex-wrap justify-content-start">
                <ul class="footer-sidebar-section col-md-4 col-sm-12">
                    <li>
                        <div class="footer-logo">
                            <a href="<?php echo get_home_url(); ?>">
                                <img src="<?php echo get_theme_mod('footer_logo'); ?>" alt="logo" class="logo">
                            </a>
                        </div>
                    </li>
                    <?php
                    if ( function_exists('dynamic_sidebar') )
                        dynamic_sidebar('first-column-sidebar');
                    ?>
                </ul>
                <ul class="footer-sidebar-section col-md-4 col-sm-12">
                    <?php
                    if ( function_exists('dynamic_sidebar') )
                        dynamic_sidebar('second-column-sidebar');
                    ?></ul>
                <ul class="footer-sidebar-section col-md-4 col-sm-12">
                    <?php
                    if ( function_exists('dynamic_sidebar') )
                        dynamic_sidebar('third-column-sidebar');
                    ?>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf( esc_html__( '© 2016 MoGo free PSD template %1$s by %2$s.', '' ), '', '<a href="http://underscores.me/">Laaqiq</a>' );
                ?>
            </div>
        </div>
		<!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
