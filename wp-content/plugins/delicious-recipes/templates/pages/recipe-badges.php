<?php
/**
 * Template Name: Recipe Tags.
 */
get_header();
$recipe_badge_terms = get_terms( array(
    'taxonomy'   => 'recipe-badge',
    'hide_empty' => true,
) );
?>
<div class="dr-page-template-wrap">
    <div class="wpdelicious-outer-wrapper">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="dr-recipe-post-wrap">
                    <?php
                        if ( ! is_wp_error( $recipe_badge_terms ) && ! empty( $recipe_badge_terms ) ) {
                            /**
                             * Get taxonomy terms search box.
                             */
                            delicious_recipes_get_template( 'pages/taxonomy/terms-box.php', [ 'terms' => $recipe_badge_terms ] );

                            /**
                             * Get terms slider template
                             */
                            delicious_recipes_get_template( 'pages/taxonomy/terms-carousal.php', [ 'terms' => $recipe_badge_terms ] );
                        } else {
                            esc_html_e( 'Terms not found for recipe badges.', 'delicious-recipes' );
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
