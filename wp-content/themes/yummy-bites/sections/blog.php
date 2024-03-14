<?php
/**
 * Blog Section
 * 
 * @package Yummy_Bites
 */
echo '<div id="acc-content"><!-- done for accessiblity purpose -->';
$defaults = yummy_bites_get_general_defaults();

$sec_title          = get_theme_mod( 'blog_main_title', $defaults['blog_main_title'] );
$sec_sub_title      = get_theme_mod( 'blog_main_content' );
$readmore           = get_theme_mod( 'blog_readmore', $defaults['blog_readmore'] );
$blog_post_per_page = get_theme_mod( 'blog_post_per_page', $defaults['blog_post_per_page'] );

if( yummy_bites_pro_is_activated() ){
    $ed_social_sharing = get_theme_mod( 'ed_social_sharing', true );
    $ed_sticky_sharing   = get_theme_mod( 'ed_sticky_social_sharing', true );
}

$args = array(
    'ignore_sticky_posts' => true,
    'posts_per_page'      => $blog_post_per_page,
    'orderby'             => array('type'=>'DESC', 'date'=>'DESC'),
);
if( yummy_bites_is_delicious_recipe_activated() ) $args['post_type'] = array('post', DELICIOUS_RECIPE_POST_TYPE );

$qry = new WP_Query( $args );

if( $sec_title || $sec_sub_title || $qry->have_posts() ){ ?>
    <div class="blog-section" id="blog_section">
        <div class="container">
            <div class="page-grid">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <section id="blog_section" class="inner-blog-section">
                            <?php if( $sec_title || $sec_sub_title ){ ?>
                                <header class="section-header">	
                                    <?php 
                                        if( $sec_title ) echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
                                        if( $sec_sub_title ) echo '<div class="section-desc">' . wp_kses_post( wpautop( $sec_sub_title ) ) . '</div>'; 
                                    ?>
                                </header>
                            <?php } ?>
                            
                            <?php if( $qry->have_posts() ){ ?>
                                <div class="blog-sec__content-wrapper">
                                    <div class="section-grid">
                                        <div class="grid-item grid__main-content">
                                            <div class="blog-sec__inner-wrapper">
                                                <?php while( $qry->have_posts() ){
                                                    $qry->the_post(); ?>
                                                    <article <?php post_class( 'post horizontal');?>>
                                                        <figure class="post-thumbnail">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if( has_post_thumbnail() ){
                                                                    the_post_thumbnail( 'yummy-bites-blog-one', array( 'itemprop' => 'image' ) );    
                                                                }else{
                                                                    yummy_bites_get_fallback_svg( 'yummy-bites-blog-one' );//fallback    
                                                                } ?>
                                                            </a>
                                                            <?php 
                                                            if( function_exists( 'yummy_bites_social_share' ) && $ed_social_sharing ) yummy_bites_social_share( $ed_sticky_sharing );
                                                            if( yummy_bites_is_delicious_recipe_activated() && DELICIOUS_RECIPE_POST_TYPE == get_post_type() ) yummy_bites_recipe_keywords(); ?>
                                                        </figure>               
                                                        <?php yummy_bites_blog_content(); ?>
                                                    </article>			
                                                    <?php 
                                                } ?>
                                            </div>
                                        </div>
                                    </div>        
                                </div>       
                            <?php } wp_reset_postdata(); ?>
                        </section>
                        <?php if( $qry->found_posts > $qry->query['posts_per_page'] ){ ?>
                        <div id="load-posts">
                            <a class="blog-load-more" data-pagenum="<?php echo max( 1, get_query_var( 'paged' ) ); ?>" data-pages="<?php echo absint( $qry->max_num_pages ); ?>"><?php echo esc_html__( 'Load More', 'yummy-bites' ); ?><svg class="svg-inline--fa fa-sync-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="sync-alt" role="img" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path></svg></a>
                        </div>
                        <?php } ?>
                    </main>
                </div>
                <?php
                if( is_active_sidebar( 'blog-sidebar' ) ){ ?>
                    <aside id="blog-sidebar" class="widget-area" itemscope itemtype="https://schema.org/WPSideBar">                         
                        <?php dynamic_sidebar( 'blog-sidebar' ); ?>
                    </aside>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
} 
wp_reset_postdata();