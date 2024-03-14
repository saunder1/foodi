<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package flawless recipe
 */

$flawless_recipe_options = flawless_recipe_theme_options();

$show_prefooter = $flawless_recipe_options['show_prefooter'];

?>

<footer id="colophon" class="site-footer">


	<?php if ($show_prefooter== 1){ ?>
	    <section class="footer-sec">
	        <div class="container">
	            <div class="row">
	                <?php if (is_active_sidebar('flawless_recipe_footer_1')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('flawless_recipe_footer_1') ?>
	                    </div>
	                    <?php
	                else: flawless_recipe_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('flawless_recipe_footer_2')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('flawless_recipe_footer_2') ?>
	                    </div>
	                    <?php
	                else: flawless_recipe_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('flawless_recipe_footer_3')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('flawless_recipe_footer_3') ?>
	                    </div>
	                    <?php
	                else: flawless_recipe_blank_widget();
	                endif; ?>
	            </div>
	        </div>
	    </section>
	<?php } ?>

		<div class="site-info">
		<p><?php esc_html_e('Powered By WordPress', 'flawless-recipe');
                    esc_html_e(' | ', 'flawless-recipe') ?>
					<span><a target="_blank" href="https://www.flawlessthemes.com/theme/flawless-recipe-best-recipe-blog-wordpress-theme/"><?php esc_html_e('Flawless Recipe' , 'flawless-recipe'); ?></a></span>
					
					
                </p> 
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
