<?php 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * After setup theme hook
 */
function spicy_recipe_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'spicy-recipe', get_stylesheet_directory() . '/languages' );

    /*
     * Add Custom Images sizes.
    */ 
    add_image_size( 'cookery-lite-blog-classic-lg', 768, 1024, true );
    add_image_size( 'cookery-lite-blog-large', 1214, 1214, true );
    add_image_size( 'cookery-lite-blog-grid', 358, 478, true );
    add_image_size( 'cookery-lite-blog-grid-full', 568, 756, true );

}
add_action( 'after_setup_theme', 'spicy_recipe_theme_setup', 100 );

function spicy_recipe_styles() {
    $my_theme = wp_get_theme();
    $version  = $my_theme['Version'];

    wp_enqueue_style( 'cookery-lite', get_template_directory_uri()  . '/style.css' );
    wp_enqueue_style( 'spicy-recipe', get_stylesheet_directory_uri() . '/style.css', array( 'cookery-lite' ), $version );
    wp_enqueue_script( 'spicy-recipe', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), $version, true );

    $array = array( 
        'rtl'  => is_rtl(),
        'loop' => (bool) get_theme_mod( 'slider_loop', true ),
        'auto' => get_theme_mod( 'slider_auto', true ),
    ); 
    wp_localize_script( 'spicy-recipe', 'spicy_recipe_data', $array );
}
add_action( 'wp_enqueue_scripts', 'spicy_recipe_styles', 10 );

//Remove a function from the parent theme
function spicy_recipe_remove_parent_filters(){ 
    remove_action( 'customize_register', 'cookery_lite_customizer_theme_info' );
    remove_action( 'customize_register', 'cookery_lite_customize_register_appearance' );
    remove_action( 'wp_head', 'cookery_lite_dynamic_css', 99 );
}
add_action( 'init', 'spicy_recipe_remove_parent_filters' );

function spicy_recipe_customizer_register( $wp_customize ) {

    $wp_customize->add_section( 'theme_info', 
        array(
            'title'    => __( 'Information Links', 'spicy-recipe' ),
            'priority' => 5,
        )
    );

    /** Important Links */
    $wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
    $theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'spicy-recipe' ),  '<a href="' . esc_url( 'https://blossomthemes.com/theme-demo/?theme=spicy-recipe' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'spicy-recipe' ),  '<a href="' . esc_url( 'https://docs.blossomthemes.com/spicy-recipe/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

    $wp_customize->add_control( new Cookery_Lite_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );

    /** Header Layout Settings */
    $wp_customize->add_section(
        'header_layout_settings',
        array(
            'title'    => __( 'Header Layout', 'spicy-recipe' ),
            'priority' => 10,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Header layout */
    $wp_customize->add_setting( 
        'header_layout', 
        array(
            'default'           => 'four',
            'sanitize_callback' => 'cookery_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Cookery_Lite_Radio_Image_Control(
            $wp_customize,
            'header_layout',
            array(
                'section'     => 'header_layout_settings',
                'label'       => __( 'Header Layout', 'spicy-recipe' ),
                'description' => __( 'Choose the layout of the header for your site.', 'spicy-recipe' ),
                'choices'     => array(
                    'one'   => get_stylesheet_directory_uri() . '/images/header/one.jpg',
                    'four'   => get_stylesheet_directory_uri() . '/images/header/four.jpg',
                )
            )
        )
    );

    /** Slider Layout Settings */
    $wp_customize->add_section(
        'slider_layout_settings',
        array(
            'title'    => __( 'Slider Layout', 'spicy-recipe' ),
            'priority' => 20,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Slider layout */
    $wp_customize->add_setting( 
        'slider_layout', 
        array(
            'default'           => 'two',
            'sanitize_callback' => 'cookery_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Cookery_Lite_Radio_Image_Control(
            $wp_customize,
            'slider_layout',
            array(
                'section'     => 'slider_layout_settings',
                'label'       => __( 'Slider Layout', 'spicy-recipe' ),
                'description' => __( 'Choose the layout of the slider for your site.', 'spicy-recipe' ),
                'choices'     => array(
                    'one'   => get_stylesheet_directory_uri() . '/images/slider/one.jpg',
                    'two'  => get_stylesheet_directory_uri() . '/images/slider/two.jpg',
                )
            )
        )
    );

    /** Home Page Layout Settings */
    $wp_customize->add_section(
        'home_layout_settings',
        array(
            'title'    => __( 'Home Page Layout', 'spicy-recipe' ),
            'priority' => 45,
            'panel'    => 'layout_settings',
        )
    );

    /** Home Page layout */
    $wp_customize->add_setting( 
        'home_layout', 
        array(
            'default'           => 'five',
            'sanitize_callback' => 'cookery_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Cookery_Lite_Radio_Image_Control(
            $wp_customize,
            'home_layout',
            array(
                'section'     => 'home_layout_settings',
                'label'       => __( 'Home Page Layout', 'spicy-recipe' ),
                'description' => __( 'Choose the home page layout for your site.', 'spicy-recipe' ),
                'choices'     => array(
                    'one'   => get_stylesheet_directory_uri() . '/images/home/one.jpg',
                    'seven' => get_stylesheet_directory_uri() . '/images/home/seven.jpg'
                )
            )
        )
    );

    $wp_customize->add_panel( 
        'appearance_settings', 
        array(
            'title'       => __( 'Appearance Settings', 'spicy-recipe' ),
            'priority'    => 25,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Change color and body background.', 'spicy-recipe' ),
        ) 
    );

    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'spicy-recipe' ),
            'priority' => 20,
            'panel'    => 'appearance_settings',
        )
    );

    /** Primary Font */
    $wp_customize->add_setting(
        'primary_font',
        array(
            'default'           => 'DM Sans',
            'sanitize_callback' => 'cookery_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Cookery_Lite_Select_Control(
            $wp_customize,
            'primary_font',
            array(
                'label'       => __( 'Primary Font', 'spicy-recipe' ),
                'description' => __( 'Primary font of the site.', 'spicy-recipe' ),
                'section'     => 'typography_settings',
                'choices'     => cookery_lite_get_all_fonts(),  
            )
        )
    );

    /** Secondary Font */
    $wp_customize->add_setting(
        'secondary_font',
        array(
            'default'           => 'Domine',
            'sanitize_callback' => 'cookery_lite_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Cookery_Lite_Select_Control(
            $wp_customize,
            'secondary_font',
            array(
                'label'       => __( 'Secondary Font', 'spicy-recipe' ),
                'description' => __( 'Secondary font of the site.', 'spicy-recipe' ),
                'section'     => 'typography_settings',
                'choices'     => cookery_lite_get_all_fonts(),  
            )
        )
    );

    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 18,
            'sanitize_callback' => 'cookery_lite_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Cookery_Lite_Slider_Control( 
            $wp_customize,
            'font_size',
            array(
                'section'     => 'typography_settings',
                'label'       => __( 'Font Size', 'spicy-recipe' ),
                'description' => __( 'Change the font size of your site.', 'spicy-recipe' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 50,
                    'step'  => 1,
                )                 
            )
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'cookery_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Cookery_Lite_Toggle_Control( 
            $wp_customize,
            'ed_localgoogle_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Load Google Fonts Locally', 'spicy-recipe' ),
                'description'   => __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies.', 'spicy-recipe' )
            )
        )
    );   

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'cookery_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Cookery_Lite_Toggle_Control( 
            $wp_customize,
            'ed_preload_local_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Preload Local Fonts', 'spicy-recipe' ),
                'description'   => __( 'Preloading Google fonts will speed up your website speed.', 'spicy-recipe' ),
                'active_callback' => 'cookery_lite_ed_localgoogle_fonts'
            )
        )
    );   

    ob_start(); ?>
        
        <span style="margin-bottom: 5px;display: block;"><?php esc_html_e( 'Click the button to reset the local fonts cache', 'spicy-recipe' ); ?></span>
        
        <input type="button" class="button button-primary cookery-lite-flush-local-fonts-button" name="cookery-lite-flush-local-fonts-button" value="<?php esc_attr_e( 'Flush Local Font Files', 'spicy-recipe' ); ?>" />
    <?php
    $spicy_recipe_flush_button = ob_get_clean();

    $wp_customize->add_setting(
        'ed_flush_local_fonts',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'ed_flush_local_fonts',
        array(
            'label'         => __( 'Flush Local Fonts Cache', 'spicy-recipe' ),
            'section'       => 'typography_settings',
            'description'   => $spicy_recipe_flush_button,
            'type'          => 'hidden',
            'active_callback' => 'cookery_lite_ed_localgoogle_fonts'
        )
    );

    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#b05045',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'spicy-recipe' ),
                'description' => __( 'Primary color of the theme.', 'spicy-recipe' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Secondary Color*/
    $wp_customize->add_setting( 
        'secondary_color', 
        array(
            'default'           => '#646f58',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color', 
            array(
                'label'       => __( 'Secondary Color', 'spicy-recipe' ),
                'description' => __( 'Secondary color of the theme.', 'spicy-recipe' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 10;
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 15;

}
add_action( 'customize_register', 'spicy_recipe_customizer_register', 40 );


function cookery_lite_body_classes( $classes ) {
    $editor_options      = get_option( 'classic-editor-replace' );
    $allow_users_options = get_option( 'classic-editor-allow-users' );
    $home_layout         = get_theme_mod( 'home_layout', 'seven' );

    if ( $home_layout == 'seven' ) {
        $home_class = 'grid-with-first-lg';
    }else{
        $home_class = 'list-with-first-lg';
    }
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    
    if ( is_singular() && ( !cookery_lite_is_classic_editor_activated() || ( cookery_lite_is_classic_editor_activated() && $editor_options == 'block' ) || ( cookery_lite_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) ) {
        $classes[] = 'cookery-lite-has-blocks';
    }

    if( is_home() ) {
        $classes[] = $home_class;
    }

    if( cookery_lite_is_delicious_recipe_activated() && is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
        $classes[] = 'single-recipe-one';
    }

    if( is_singular( 'post' ) ) {
        $classes[] = 'single-post-one';
    }
    
    if( is_archive() || is_search() ) {
        $classes[] = 'list-with-all-tall-img';
    }

    $classes[] = cookery_lite_sidebar( true );
    
    return $classes;
}

function cookery_lite_post_thumbnail() {
    if( cookery_lite_is_delicious_recipe_activated() && is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) return false;
    
    global $wp_query;
    $image_size     = 'thumbnail';
    $ed_featured    = get_theme_mod( 'ed_featured_image', true );
    $ed_crop_blog   = get_theme_mod( 'ed_crop_blog', false );
    $ed_crop_single = get_theme_mod( 'ed_crop_single', false );
    $sidebar        = cookery_lite_sidebar();
    $home_layout    = get_theme_mod( 'home_layout', 'seven' );

    if( is_home() ){
        if( $home_layout == 'seven' ) {
            if( $wp_query->current_post == 0 ) {
                $image_size = ( $sidebar ) ? 'cookery-lite-blog-classic-lg' : 'cookery-lite-blog-large';
            }else{
                $image_size = ( $sidebar ) ? 'cookery-lite-blog-grid' : 'cookery-lite-blog-grid-full';
            }
        }else{      
            if( $wp_query->current_post == 0 ) {
                $image_size = ( $sidebar ) ? 'cookery-lite-blog-list-lg' : 'cookery-lite-blog-large';
            }else{
                $image_size = ( $sidebar ) ? 'cookery-lite-blog' : 'cookery-lite-slider';
            }
        }

        if( has_post_thumbnail() ){                        
            echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
            if( $ed_crop_blog ){
                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
            }else{
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
            }
            echo '</a>';       
            if( cookery_lite_is_delicious_recipe_activated() && DELICIOUS_RECIPE_POST_TYPE == get_post_type() ) cookery_lite_recipe_pinit();       
            if( cookery_lite_is_delicious_recipe_activated() && DELICIOUS_RECIPE_POST_TYPE == get_post_type() ) cookery_lite_recipe_keywords();       
            echo '</figure>';
        }
    }elseif( is_archive() || is_search() ){
        if( has_post_thumbnail() ){
            echo '<figure  class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
            if( $ed_crop_blog ){
                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
            }else{
                the_post_thumbnail( 'cookery-lite-blog-archive', array( 'itemprop' => 'image' ) );    
            }
            echo '</a>';
            if( cookery_lite_is_delicious_recipe_activated() && DELICIOUS_RECIPE_POST_TYPE == get_post_type() ) cookery_lite_recipe_pinit();       
            if( cookery_lite_is_delicious_recipe_activated() && DELICIOUS_RECIPE_POST_TYPE == get_post_type() ) cookery_lite_recipe_keywords();
            echo '</figure>';
        }
    }elseif( is_singular() ){
        $image_size = ( $sidebar ) ? 'cookery-lite-single' : 'cookery-lite-single-two';
        if( is_single() ){
            if( $ed_featured && has_post_thumbnail() ){
                echo '<div class="post-thumbnail">';
                if( $ed_crop_single ){
                    the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
                }else{
                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                }
                echo '</div>';    
            }
        }else{
            if( has_post_thumbnail() ){
                echo '<div class="post-thumbnail">';
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                echo '</div>';    
            }            
        }
    }
}

function cookery_lite_header_search(){
    $header_layout = get_theme_mod( 'header_layout', 'four' ); ?>

    <div class="header-search">
        <?php if( $header_layout != 'four' ) : ?>
            <button class="search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.691" height="21.932" viewBox="0 0 22.691 21.932">
                    <g id="Group_258" data-name="Group 258" transform="matrix(0.966, -0.259, 0.259, 0.966, -1515.787, 248.902)">
                        <g id="Ellipse_9" data-name="Ellipse 9" transform="translate(1525.802 162.18) rotate(-30)" fill="none" stroke="#6a6a6a" stroke-width="2.5">
                            <circle cx="7.531" cy="7.531" r="7.531" stroke="none"></circle>
                            <circle cx="7.531" cy="7.531" r="6.281" fill="none"></circle>
                        </g>
                        <path id="Path_4339" data-name="Path 4339" d="M0,0V7" transform="translate(1540.052 170.724) rotate(-30)" fill="none" stroke="#6a6a6a" stroke-linecap="round" stroke-width="2.5"></path>
                    </g>
                </svg>
            </button>
            <div class="header-search-wrap search-modal cover-modal" data-modal-target-string=".search-modal">
                <div class="header-search-inner">
        <?php endif; ?>
                <?php get_search_form(); ?>
        <?php if( $header_layout != 'four' ) : ?>
                <button class="close" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false"></button>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Header Start
*/
function cookery_lite_header() {
    $ed_cart       = get_theme_mod('ed_shopping_cart', true);
    $ed_search     = get_theme_mod('ed_header_search', true);
    $header_layout = get_theme_mod('header_layout', 'four'); ?>

    <?php cookery_lite_mobile_header(); ?>

    <header id="masthead" class="site-header style-<?php echo esc_attr($header_layout); ?>" itemscope itemtype="http://schema.org/WPHeader">

        <div class="header-main">
            <div class="container">
                <?php
                cookery_lite_site_branding();

                if ($header_layout == 'four') {
                    cookery_lite_primary_navigation();
                    echo '<div class="header-right">';
                    if (cookery_lite_is_woocommerce_activated() && $ed_cart) {
                        echo '<div class="header-cart">';
                        cookery_lite_wc_cart_count();
                        echo '</div>';
                    }
                    if (is_user_logged_in()) {
                        echo '<div class="header-login">';
                        echo '<a href="' . wp_logout_url() . '">Log Out</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="header-login">';
                        echo '<a href="' . wp_login_url() . '">Log In</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <?php
        if ($header_layout == 'one') { ?>
            <div class="header-bottom">
                <div class="container">
                    <?php cookery_lite_primary_navigation(); ?>
                    <div class="header-right">
                        <?php
                        if (cookery_lite_is_woocommerce_activated() && $ed_cart) {
                            echo '<div class="header-cart">';
                            cookery_lite_wc_cart_count();
                            echo '</div>';
                        }
                        if (is_user_logged_in()) {
                            echo '<div class="header-login">';
                            echo '<a href="' . wp_logout_url() . '">Log Out</a>';
                            echo '</div>';
                        } else {
                            echo '<div class="header-login">';
                            echo '<a href="' . wp_login_url() . '">Login</a>';
							echo '<a>&nbsp|&nbsp</a>';
							echo '<a href="http://classes.dustinohara.com/CSCI348/w24/wordpress_2/recipe-dashboard/?register=1">Sign Up</a>';
                            echo '</div>';
                        }
                        if ($ed_search) cookery_lite_header_search();
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </header>
    <?php
}


/**
 * Banner
*/
function cookery_lite_banner() {
    if (is_front_page() || is_home()) {
        $ed_banner = get_theme_mod('ed_banner_section', 'slider_banner');
        $slider_type = get_theme_mod('slider_type', 'latest_posts');
        $posts_per_page = get_theme_mod('no_of_slides', 5);
        $ed_full_image = get_theme_mod('slider_full_image', false);
        $ed_caption = get_theme_mod('slider_caption', true);
        $read_more = get_theme_mod('slider_readmore', __('Continue Reading', 'spicy-recipe'));
        $slider_layout = get_theme_mod('slider_layout', 'two');

        $image_size = array(500, 500); // Set the image size to 500x500 pixels

        if ($ed_banner == 'static_banner' && has_custom_header()) {
            cookery_lite_static_cta_banner();
        } elseif ($ed_banner == 'slider_banner') {
            if ($slider_type == 'latest_posts' || (cookery_lite_is_delicious_recipe_activated() && $slider_type == 'latest_recipes')) {

                $args = array(
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true
                );

                if (cookery_lite_is_delicious_recipe_activated() && $slider_type == 'latest_recipes') {
                    $args['post_type'] = DELICIOUS_RECIPE_POST_TYPE;
                    $args['posts_per_page'] = $posts_per_page;
                } else {
                    $args['post_type'] = 'post';
                    $args['posts_per_page'] = $posts_per_page;
                }

                $qry = new WP_Query($args);

                if ($qry->have_posts()) { ?>
                    <div id="banner_section" class="site-banner banner-slider style-<?php echo esc_attr($slider_layout); ?>">
						<h2 id="banner-title" style="text-align:center;background-color:#fdf2f2;margin:auto;font-size:1.8em;padding:1.5em">Featured Weekly Recipes</h2>
                        <div class="item-wrapper owl-carousel">
                            <?php while ($qry->have_posts()) {
                                $qry->the_post(); ?>
                                <div class="item">
                                    <?php
                                    echo '<div class="item-img">';
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail($image_size, array('itemprop' => 'image'));
                                    } else {
                                        cookery_lite_get_fallback_svg($image_size); //fallback
                                    }
                                    echo '</div>';
                                    if ($ed_caption) { ?>
                                        <div class="banner-caption">
                                            <?php cookery_lite_slider_meta_contents(); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
        <?php
                }
                wp_reset_postdata();
            }
        }
    }
}


/**
 * Footer Bottom
*/
function cookery_lite_footer_bottom(){ ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="site-info">            
            <?php
                cookery_lite_get_footer_copyright();
                echo esc_html__( ' Spicy Recipe | Developed By ', 'spicy-recipe' ); 
                echo '<a href="' . esc_url( 'https://blossomthemes.com/wordpress-themes/spicy-recipe/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Blossom Themes', 'spicy-recipe' ) . '</a>.';                
                printf( esc_html__( ' Powered by %s. ', 'spicy-recipe' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'spicy-recipe' ) ) .'" target="_blank">WordPress</a>' );
                if( function_exists( 'the_privacy_policy_link' ) ){
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <div class="footer-menu">
                <?php cookery_lite_footer_navigation(); ?>
            </div>
            <button class="back-to-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M6.101 359.293L25.9 379.092c4.686 4.686 12.284 4.686 16.971 0L224 198.393l181.13 180.698c4.686 4.686 12.284 4.686 16.971 0l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L232.485 132.908c-4.686-4.686-12.284-4.686-16.971 0L6.101 342.322c-4.687 4.687-4.687 12.285 0 16.971z"></path>
                </svg>
            </button><!-- .back-to-top -->
        </div>
    </div>
    <?php
}

/**
 * Ajax Callback
 */
function cookery_lite_dynamic_mce_css_ajax_callback(){
 
    /* Check nonce for security */
    $nonce = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
    if( ! wp_verify_nonce( $nonce, 'cookery_lite_dynamic_mce_nonce' ) ){
        die(); // don't print anything
    }
 
    /* Get Link Color */
    $primary_font    = get_theme_mod( 'primary_font', 'DM Sans' );
    $primary_fonts   = cookery_lite_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Domine' );
    $secondary_fonts = cookery_lite_get_fonts( $secondary_font, 'regular' );

    $primary_color    = get_theme_mod( 'primary_color', '#b05045' ); 
    $secondary_color  = get_theme_mod( 'secondary_color', '#646f58' ); 

    $rgb = cookery_lite_hex2rgb( cookery_lite_sanitize_hex_color( $primary_color ) );
    $rgb2 = cookery_lite_hex2rgb( cookery_lite_sanitize_hex_color( $secondary_color ) );
 
    /* Set File Type and Print the CSS Declaration */
    header( 'Content-type: text/css' );
    echo ':root .mce-content-body {
        --primary-color: ' . cookery_lite_sanitize_hex_color( $primary_color ) . ';
        --primary-color-rgb: ' . sprintf( '%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ) . ';
        --secondary-color: ' . cookery_lite_sanitize_hex_color( $secondary_color ) . ';
        --secondary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ) . ';
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
    }

    .mce-content-body blockquote::before, 
    .mce-content-body q::before {
        content: "";
        background-image: url(\'data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="64" height="40.062" viewBox="0 0 64 40.062"><path d="M68.871,47.073A12.886,12.886,0,0,0,56.71,36.191c1.494-5.547,5.121-7.752,9.53-9.032a.515.515,0,0,0,.356-.569l-.711-4.409s-.071-.356-.64-.284C50.024,23.6,39.712,35.2,41.632,49.277,43.41,59.021,51.02,62.79,58.061,61.794a12.968,12.968,0,0,0,10.81-14.722ZM20.3,36.191c1.422-5.547,5.192-7.752,9.53-9.032a.515.515,0,0,0,.356-.569l-.64-4.409s-.071-.356-.64-.284C13.682,23.532,3.441,35.124,5.219,49.206c1.849,9.815,9.53,13.584,16.5,12.588A12.865,12.865,0,0,0,32.458,47.073,12.693,12.693,0,0,0,20.3,36.191Z" transform="translate(-5.018 -21.887)" fill="' . cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ) . '"/></svg>\');
    }';
    die(); // end ajax process.
}

/**
 * Gutenberg Dynamic Style
 */
function cookery_lite_gutenberg_inline_style(){
 
    /* Get Link Color */
    $primary_font    = get_theme_mod( 'primary_font', 'DM Sans' );
    $primary_fonts   = cookery_lite_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Domine' );
    $secondary_fonts = cookery_lite_get_fonts( $secondary_font, 'regular' );

    $primary_color    = get_theme_mod( 'primary_color', '#b05045' ); 
    $secondary_color  = get_theme_mod( 'secondary_color', '#646f58' ); 

    $rgb = cookery_lite_hex2rgb( cookery_lite_sanitize_hex_color( $primary_color ) );
    $rgb2 = cookery_lite_hex2rgb( cookery_lite_sanitize_hex_color( $secondary_color ) );
 
    $custom_css = ':root .block-editor-page {
        --primary-color: ' . cookery_lite_sanitize_hex_color( $primary_color ) . ';
        --primary-color-rgb: ' . sprintf( '%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ) . ';
        --secondary-color: ' . cookery_lite_sanitize_hex_color( $secondary_color ) . ';
        --secondary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ) . ';
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
    }

    blockquote.wp-block-quote::before {
        background-image: url(\'data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="64" height="40.062" viewBox="0 0 64 40.062"><path d="M68.871,47.073A12.886,12.886,0,0,0,56.71,36.191c1.494-5.547,5.121-7.752,9.53-9.032a.515.515,0,0,0,.356-.569l-.711-4.409s-.071-.356-.64-.284C50.024,23.6,39.712,35.2,41.632,49.277,43.41,59.021,51.02,62.79,58.061,61.794a12.968,12.968,0,0,0,10.81-14.722ZM20.3,36.191c1.422-5.547,5.192-7.752,9.53-9.032a.515.515,0,0,0,.356-.569l-.64-4.409s-.071-.356-.64-.284C13.682,23.532,3.441,35.124,5.219,49.206c1.849,9.815,9.53,13.584,16.5,12.588A12.865,12.865,0,0,0,32.458,47.073,12.693,12.693,0,0,0,20.3,36.191Z" transform="translate(-5.018 -21.887)" fill="' . cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ) . '"/></svg>\');
    }';

    return $custom_css;
}

function cookery_lite_fonts_url(){
    $fonts_url = '';
    
    $primary_font       = get_theme_mod( 'primary_font', 'DM Sans' );
    $ig_primary_font    = cookery_lite_is_google_font( $primary_font );    
    $secondary_font     = get_theme_mod( 'secondary_font', 'Domine' );
    $ig_secondary_font  = cookery_lite_is_google_font( $secondary_font );    
    $site_title_font    = get_theme_mod( 'site_title_font', array( 'font-family'=>'Noto Serif', 'variant'=>'regular' ) );
    $ig_site_title_font = cookery_lite_is_google_font( $site_title_font['font-family'] );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'spicy-recipe' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'spicy-recipe' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'spicy-recipe' );
    
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title ) {
        
        $font_families = array();
     
        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = cookery_lite_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }
         
        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = cookery_lite_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            
            if( ! empty( $site_title_font['variant'] ) ){
                $site_title_var = ':' . cookery_lite_check_varient( $site_title_font['font-family'], $site_title_font['variant'] );    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font['font-family'] . $site_title_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    if( get_theme_mod( 'ed_localgoogle_fonts', false ) ) {
        $fonts_url = cookery_lite_get_webfont_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
    }
     
    return esc_url( $fonts_url );
}

/** Dynamic CSS */
function spicy_recipe_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'DM Sans' );
    $primary_fonts   = cookery_lite_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Domine' );
    $secondary_fonts = cookery_lite_get_fonts( $secondary_font, 'regular' );

    $font_size       = get_theme_mod( 'font_size', 18 );
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Noto Serif', 'variant'=>'regular' ) );
    $site_title_fonts     = cookery_lite_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
    
    $primary_color    = get_theme_mod( 'primary_color', '#b05045' ); 
    $secondary_color  = get_theme_mod( 'secondary_color', '#646f58' ); 
    $logo_width       = get_theme_mod( 'logo_width', 150 );
    $static_cta_one_color  = get_theme_mod( 'static_cta_one_color', '#ffffff' );
    $enable_typography = '';

    $featured_recipe_bg = get_theme_mod( 'featured_recipe_bg' );
    $client_section_bg  = get_theme_mod( 'client_section_bg' );
    $footer_newsletter_bg = get_theme_mod( 'newsletter_section_bg' );

    if( cookery_lite_is_delicious_recipe_activated() ){
        $global_settings = delicious_recipes_get_global_settings();
        $enable_typography = ( isset( $global_settings['enablePluginTypography']['0'] ) && 'yes' === $global_settings['enablePluginTypography']['0'] ) ? true : false;
    }
    
    $rgb = cookery_lite_hex2rgb( cookery_lite_sanitize_hex_color( $primary_color ) );
    $rgb2 = cookery_lite_hex2rgb( cookery_lite_sanitize_hex_color( $secondary_color ) );
     
    echo "<style type='text/css' media='all'>"; ?>
     
    .content-newsletter .blossomthemes-email-newsletter-wrapper.bg-img:after,
    .widget_blossomthemes_email_newsletter_widget .blossomthemes-email-newsletter-wrapper:after{
        <?php echo 'background: rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.8);'; ?>
    }

    section.featured-recipe-section::after {
        background-image: url('<?php echo esc_url( $featured_recipe_bg ); ?>');
    }

    .client-section::after {
        background-image: url('<?php echo esc_url( $client_section_bg ); ?>');
    }

    section.footer-newsletter-section::after {
        background-image: url('<?php echo esc_url( $footer_newsletter_bg ); ?>');
    }
    
   /*Typography*/

    :root {
        --primary-color: <?php echo cookery_lite_sanitize_hex_color( $primary_color ); ?>;
        --primary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ); ?>;
        --secondary-color: <?php echo cookery_lite_sanitize_hex_color( $secondary_color ); ?>;
        --secondary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ); ?>;
        --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
        --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
        <?php if( ! $enable_typography ) { ?> --dr-primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>; <?php } ?>
        <?php if( ! $enable_typography ) { ?> --dr-secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>; <?php } ?>
    }

    body {
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }
    
    .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }

    .custom-logo-link img{
        width    : <?php echo absint( $logo_width ); ?>px;
        max-width: 100%;
    }

    .site-banner.static-cta.style-one .banner-caption .item-title,
    .site-banner.static-cta.style-one .banner-caption .item-desc{
        color: <?php echo cookery_lite_sanitize_hex_color( $static_cta_one_color ); ?>;
    }

    blockquote::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="64" height="40.062" viewBox="0 0 64 40.062"><path d="M68.871,47.073A12.886,12.886,0,0,0,56.71,36.191c1.494-5.547,5.121-7.752,9.53-9.032a.515.515,0,0,0,.356-.569l-.711-4.409s-.071-.356-.64-.284C50.024,23.6,39.712,35.2,41.632,49.277,43.41,59.021,51.02,62.79,58.061,61.794a12.968,12.968,0,0,0,10.81-14.722ZM20.3,36.191c1.422-5.547,5.192-7.752,9.53-9.032a.515.515,0,0,0,.356-.569l-.64-4.409s-.071-.356-.64-.284C13.682,23.532,3.441,35.124,5.219,49.206c1.849,9.815,9.53,13.584,16.5,12.588A12.865,12.865,0,0,0,32.458,47.073,12.693,12.693,0,0,0,20.3,36.191Z" transform="translate(-5.018 -21.887)" fill="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>"/></svg>');
    }
    
    .comments-area .comment-list li .comment-body .reply .comment-reply-link::after {
        background-image: url('data:image/svg+xml;utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="14.796" height="10.354" viewBox="0 0 14.796 10.354"><g transform="translate(0.75 1.061)"><path d="M7820.11-1126.021l4.117,4.116-4.117,4.116" transform="translate(-7811.241 1126.021)" fill="none" stroke="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="1.5"></path><path d="M6555.283-354.415h-12.624" transform="translate(-6542.659 358.532)" fill="none" stroke="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="1.5"></path></g></svg>');
    }

    .static-search .item .search-form-wrap .search-submit {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="29.434" height="29.434" viewBox="0 0 29.434 29.434"><g transform="translate(-663.027 -502.431)"><g transform="translate(692.461 517.148) rotate(135)" fill="none" stroke="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" stroke-width="2.5"><circle cx="10.406" cy="10.406" r="10.406" stroke="none"/><circle cx="10.406" cy="10.406" r="9.156" fill="none"/></g><path d="M0,6.907V0" transform="translate(689.718 529.122) rotate(135)" fill="none" stroke="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="2.5"/></g></svg>');
    }

    .newsletter .blossomthemes-email-newsletter-wrapper form [type="submit"]:hover::after, 
    .widget_blossomthemes_email_newsletter_widget form [type="submit"]:hover::after {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="18.479" height="12.689" viewBox="0 0 18.479 12.689"><g transform="translate(0.75 1.061)"><path d="M7820.11-1126.021l5.284,5.284-5.284,5.284" transform="translate(-7808.726 1126.021)" fill="none" stroke="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="1.5"/><path d="M6558.865-354.415H6542.66" transform="translate(-6542.66 359.699)" fill="none" stroke="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="1.5"/></g></svg>');
    }

    .search .page-header .search-form .search-submit, 
    .error404 .error-404-search .search-form .search-submit {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="21.863" height="22" viewBox="0 0 21.863 22"><path d="M24.863,1170.255l-2.045,2.045L18,1167.482v-1.091l-.409-.409a8.674,8.674,0,0,1-5.727,2.046,8.235,8.235,0,0,1-6.273-2.591A8.993,8.993,0,0,1,3,1159.164a8.235,8.235,0,0,1,2.591-6.273,8.993,8.993,0,0,1,6.273-2.591,8.441,8.441,0,0,1,6.273,2.591,8.993,8.993,0,0,1,2.591,6.273,8.675,8.675,0,0,1-2.045,5.727l.409.409h.955ZM7.5,1163.664a5.76,5.76,0,0,0,4.364,1.773,5.969,5.969,0,0,0,4.364-1.773,6.257,6.257,0,0,0,0-8.727,5.76,5.76,0,0,0-4.364-1.773,5.969,5.969,0,0,0-4.364,1.773,5.76,5.76,0,0,0-1.773,4.364A6.308,6.308,0,0,0,7.5,1163.664Z" transform="translate(-3 -1150.3)" fill="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>"/></svg>');
    }
    
    .posts-navigation .nav-links a:hover::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" d="M20.2 247.5L167 99.5c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.7 4.7 4.7 12.3 0 17L85.3 256l118.5 119.7c4.7 4.7 4.7 12.3 0 17L184 412.5c-4.7 4.7-12.3 4.7-17 0l-146.8-148c-4.7-4.7-4.7-12.3 0-17zm160 17l146.8 148c4.7 4.7 12.3 4.7 17 0l19.8-19.8c4.7-4.7 4.7-12.3 0-17L245.3 256l118.5-119.7c4.7-4.7 4.7-12.3 0-17L344 99.5c-4.7-4.7-12.3-4.7-17 0l-146.8 148c-4.7 4.7-4.7 12.3 0 17z"></path></svg>');
    }

    .posts-navigation .nav-links .nav-next a:hover::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>" d="M363.8 264.5L217 412.5c-4.7 4.7-12.3 4.7-17 0l-19.8-19.8c-4.7-4.7-4.7-12.3 0-17L298.7 256 180.2 136.3c-4.7-4.7-4.7-12.3 0-17L200 99.5c4.7-4.7 12.3-4.7 17 0l146.8 148c4.7 4.7 4.7 12.3 0 17zm-160-17L57 99.5c-4.7-4.7-12.3-4.7-17 0l-19.8 19.8c-4.7 4.7-4.7 12.3 0 17L138.7 256 20.2 375.7c-4.7 4.7-4.7 12.3 0 17L40 412.5c4.7 4.7 12.3 4.7 17 0l146.8-148c4.7-4.7 4.7-12.3 0-17z"></path></svg>');
    }

    .search-form .search-submit:hover {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="21.863" height="22" viewBox="0 0 21.863 22"><path d="M24.863,1170.255l-2.045,2.045L18,1167.482v-1.091l-.409-.409a8.674,8.674,0,0,1-5.727,2.046,8.235,8.235,0,0,1-6.273-2.591A8.993,8.993,0,0,1,3,1159.164a8.235,8.235,0,0,1,2.591-6.273,8.993,8.993,0,0,1,6.273-2.591,8.441,8.441,0,0,1,6.273,2.591,8.993,8.993,0,0,1,2.591,6.273,8.675,8.675,0,0,1-2.045,5.727l.409.409h.955ZM7.5,1163.664a5.76,5.76,0,0,0,4.364,1.773,5.969,5.969,0,0,0,4.364-1.773,6.257,6.257,0,0,0,0-8.727,5.76,5.76,0,0,0-4.364-1.773,5.969,5.969,0,0,0-4.364,1.773,5.76,5.76,0,0,0-1.773,4.364A6.308,6.308,0,0,0,7.5,1163.664Z" transform="translate(-3 -1150.3)" fill="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $secondary_color ) ); ?>"/></svg>');
    }

    .woocommerce .woocommerce-ordering select,
    .woocommerce-page .woocommerce-ordering select{
       background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8"><path d="M7.5,0,15,8H0Z" transform="translate(15 8) rotate(180)" fill="<?php echo cookery_lite_hash_to_percent23( cookery_lite_sanitize_hex_color( $primary_color ) ); ?>"/></svg>');
    }
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'spicy_recipe_dynamic_css', 99 );

