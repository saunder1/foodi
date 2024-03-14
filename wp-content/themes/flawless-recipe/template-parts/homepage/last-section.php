<?php
$flawless_recipe_options = flawless_recipe_theme_options();
$last_recipe_column = $flawless_recipe_options['last_recipe_column'];
$last_section_title = $flawless_recipe_options['last_section_title'];
?>

<?php
if ($last_recipe_column && 'none' != $last_recipe_column) {
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'menu_order date',
        'tax_query' => [
            'relation' => 'AND',
            [
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => [$last_recipe_column],
            ],
        ],
    ];
} else {
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'menu_order date',
    ];
}

$blog_query = new WP_Query($args);
$loop = 0;

if ($blog_query->have_posts()): ?>

<div class="carousel-section section">
<div class="container">
<div class="row">
<?php if ($last_section_title): ?>
                        <div class="section-title">
                       
                            <?php


                            
                            if ($last_section_title)
                                echo '<h2> <span>' . esc_html($last_section_title) . ' </span></h2>';
                            
                            ?>
                          
                        </div>
                    <?php endif; ?>
</div>
</div>
	<div class="container">
		<div class="row">
			<div class="recipe-slider-wrap">

            <?php
            while ($blog_query->have_posts()):

                $blog_query->the_post();

                    $image_src = wp_get_attachment_image_src(
                        get_post_thumbnail_id(),
                        'flawless-recipe-blog-custom-size'
                    );

      
                ?>

   
					<div class="post-content-wrap">
						<div class="post-thumb">
                        
                        <?php       if($image_src){ ?><a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($image_src[0]); ?>"></a> <?php } ?>
						</div>
						<div class="post-content">
                        <div class="category-btn-wrap">
                            <?php 
                            $categories = get_the_category();
                            $separator = ',';
                            $output = '';
                            if ( ! empty( $categories ) ) {
                                foreach( $categories as $category ) {
                                    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'flawless-recipe' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                }
                                echo trim( $output, $separator );
                            }
                            ?>
                            </div>
							<h3>
								<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
							</h3>
                            
						</div>
					</div>


                <?php
            endwhile;
            wp_reset_postdata();
            ?>
			</div>
		</div>
	</div>
</div>

<?php endif;
?>

