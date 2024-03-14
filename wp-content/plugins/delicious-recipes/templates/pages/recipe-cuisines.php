<?php
/**
 * Template Name: Recipe Cuisines.
 */
get_header();
$recipe_cuisine_terms = get_terms( array(
    'taxonomy'   => 'recipe-cuisine',
    'hide_empty' => true,
) );
?>
<div class="dr-page-template-wrap">
    <div class="wpdelicious-outer-wrapper">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="dr-recipe-post-wrap">
                    <?php
                        if ( ! is_wp_error( $recipe_cuisine_terms ) && ! empty( $recipe_cuisine_terms ) ) {
                            /**
                             * Get taxonomy terms search box.
                             */
                            delicious_recipes_get_template( 'pages/taxonomy/terms-box.php', [ 'terms' => $recipe_cuisine_terms ] );

                            /**
                             * Get terms slider template
                             */
                            delicious_recipes_get_template( 'pages/taxonomy/terms-carousal.php', [ 'terms' => $recipe_cuisine_terms ] );
                        } else {
                            esc_html_e( 'Terms not found for recipe cuisines.', 'delicious-recipes' );
                        }
                    ?>
                </div>
            </main>
        </div><!-- #primary -->
        <?php do_action( 'delicious_recipes_sidebar' );?>
    </div>
</div>
<?php
get_footer();
