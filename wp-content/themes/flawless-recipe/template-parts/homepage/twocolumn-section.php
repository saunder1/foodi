<?php
$flawless_recipe_options = flawless_recipe_theme_options();
$small_recipe_grid = $flawless_recipe_options['small_recipe_grid'];
$section_title1 = $flawless_recipe_options['section_title1'];
$section_title2 = $flawless_recipe_options['section_title2'];
$big_recipe_grid = $flawless_recipe_options['big_recipe_grid'];
?>



<div class="carousel-section section">
	<div class="container">
		<div class="row">
		<div class="col-md-5">
		

                    <?php if ($section_title1): ?>
                        <div class="section-title">
                     
                            <?php


                            
                            if ($section_title1)
                                echo '<h2>   <span>' . esc_html($section_title1) . ' </span></h2>';
                            
                            ?>
                          
                        </div>
                    <?php endif; ?>

             
			<div class="small-recipe-wrap">
            <?php
if ($small_recipe_grid && 'none' != $small_recipe_grid) {
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
                'terms' => [$small_recipe_grid],
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
            <?php
            while ($blog_query->have_posts()):

                $blog_query->the_post();

                    $image_src = wp_get_attachment_image_src(
                        get_post_thumbnail_id(),
                        'flawless-recipe-blog-big-img'
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
			
<?php endif;
?>
			</div>
		    <div class="col-md-7">
            <?php if ($section_title2): ?>
                        <div class="section-title">
                       
                            <?php


                            
                            if ($section_title2)
                                echo '<h2> <span>' . esc_html($section_title2) . ' </span></h2>';
                            
                            ?>
                          
                        </div>
                    <?php endif; ?>
			<div class="big-slider-wrap">
            <?php
if ($big_recipe_grid && 'none' != $big_recipe_grid) {
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
                'terms' => [$big_recipe_grid],
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
            <?php
            while ($blog_query->have_posts()):

                $blog_query->the_post();

                    $image_src = wp_get_attachment_image_src(
                        get_post_thumbnail_id(),
                        'flawless-recipe-blog-big-img'
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
			
<?php endif;
?>
			</div>
		</div>
	</div>
</div>


