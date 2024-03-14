<?php
/**
 * Flawless Recipe Theme Customizer
 *
 * @package flawless recipe
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flawless_recipe_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$flawless_recipe_options = flawless_recipe_theme_options();

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'flawless_recipe_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'flawless_recipe_customize_partial_blogdescription',
			)
		);
	}

    $wp_customize->add_setting('flawless_recipe_theme_options[site_title_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $flawless_recipe_options['site_title_show'],
            'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('flawless_recipe_theme_options[site_title_show]',
        array(
            'label' => esc_html__('Show Title & Tagline', 'flawless-recipe'),
            'type' => 'Checkbox',
            'section' => 'title_tagline',

        )
    );
    $wp_customize->add_panel(
        'general_setting',
        array(
            'title' => esc_html__('General Settings', 'flawless-recipe'),
            'priority' => 1,
        )
    );

    $wp_customize->add_section(
        'header_section',
        array(
            'title' => esc_html__( 'Header Section','flawless-recipe' ),
            'panel'=>'general_setting',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('flawless_recipe_theme_options[facebook]', [
        'type' => 'option',
        'default' => $flawless_recipe_options['facebook'],
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('flawless_recipe_theme_options[facebook]', [
        'label' => esc_html__('Facebook Link', 'flawless-recipe'),
        'description' => esc_html__('Only 2 social links are available in free version', 'flawless-recipe'),
        'type' => 'url',
        'section' => 'header_section',
        'settings' => 'flawless_recipe_theme_options[facebook]',
    ]);

    $wp_customize->add_setting('flawless_recipe_theme_options[twitter]', [
        'type' => 'option',
        'default' => $flawless_recipe_options['twitter'],
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('flawless_recipe_theme_options[twitter]', [
        'label' => esc_html__('Twitter Link', 'flawless-recipe'),
        'type' => 'url',
        'section' => 'header_section',
        'settings' => 'flawless_recipe_theme_options[twitter]',
    ]);

    $wp_customize->add_section(
        'blog_section',
        array(
            'title' => esc_html__( 'Blog Cards','flawless-recipe' ),
            'panel'=>'general_setting',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting('flawless_recipe_theme_options[show_image]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $flawless_recipe_options['show_image'],
            'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('flawless_recipe_theme_options[show_image]',
        array(
            'label' => esc_html__('Show Featured Image in Blog Cards and Single Posts Page', 'flawless-recipe'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'blog_section',

        )
    );
    $wp_customize->add_setting('flawless_recipe_theme_options[show_blog_date]',
    array(
        'type' => 'option',
        'default'        => true,
        'default' => $flawless_recipe_options['show_blog_date'],
        'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
    )
);

$wp_customize->add_control('flawless_recipe_theme_options[show_blog_date]',
    array(
        'label' => esc_html__('Show Date Meta in Blog Cards and Single Posts Page', 'flawless-recipe'),
        'type' => 'Checkbox',
        'priority' => 1,
        'section' => 'blog_section',

    )
);

$wp_customize->add_setting('flawless_recipe_theme_options[show_blog_author]',
array(
    'type' => 'option',
    'default'        => true,
    'default' => $flawless_recipe_options['show_blog_author'],
    'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
)
);

$wp_customize->add_control('flawless_recipe_theme_options[show_blog_author]',
array(
    'label' => esc_html__('Show Author Meta in Blog Cards and Single Posts Page', 'flawless-recipe'),
    'type' => 'Checkbox',
    'priority' => 1,
    'section' => 'blog_section',

)
);

$wp_customize->add_setting('flawless_recipe_theme_options[show_excerpts]',
array(
    'type' => 'option',
    'default'        => true,
    'default' => $flawless_recipe_options['show_excerpts'],
    'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
)
);

$wp_customize->add_control('flawless_recipe_theme_options[show_excerpts]',
array(
    'label' => esc_html__('Show Excerpts in Blog Cards', 'flawless-recipe'),
    'type' => 'Checkbox',
    'priority' => 1,
    'section' => 'blog_section',

)
);

$wp_customize->add_section(
    'single_post',
    array(
        'title' => esc_html__( 'Single Posts','flawless-recipe' ),
        'panel'=>'general_setting',
        'capability'=>'edit_theme_options',
    )
);
$wp_customize->add_setting('flawless_recipe_theme_options[show_single_sidebar]',
array(
    'type' => 'option',
    'default'        => true,
    'default' => $flawless_recipe_options['show_single_sidebar'],
    'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
)
);

$wp_customize->add_control('flawless_recipe_theme_options[show_single_sidebar]',
array(
    'label' => esc_html__('Show Sidebar in Single Posts Page', 'flawless-recipe'),
    'type' => 'Checkbox',
    'priority' => 1,
    'section' => 'single_post',

)
);


$wp_customize->add_section(
    'preloader_section',
    array(
        'title' => esc_html__( 'Preloader Section','flawless-recipe' ),
        'panel'=>'general_setting',
        'capability'=>'edit_theme_options',
    )
);
$wp_customize->add_setting('flawless_recipe_theme_options[show_preloader]',
array(
    'type' => 'option',
    'default'        => true,
    'default' => $flawless_recipe_options['show_preloader'],
    'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
)
);

$wp_customize->add_control('flawless_recipe_theme_options[show_preloader]',
array(
    'label' => esc_html__('Show Pre-Loader', 'flawless-recipe'),
    'type' => 'Checkbox',
    'priority' => 1,
    'section' => 'preloader_section',

)
);




    $wp_customize->add_section(
        'prefooter_section',
        array(
            'title' => esc_html__( 'Prefooter Section','flawless-recipe' ),
            'panel'=>'general_setting',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('flawless_recipe_theme_options[show_prefooter]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $flawless_recipe_options['show_prefooter'],
            'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('flawless_recipe_theme_options[show_prefooter]',
        array(
            'label' => esc_html__('Show Prefooter Section', 'flawless-recipe'),
			'description' => esc_html__('Copyright text can be changed in Premium Version only', 'flawless-recipe'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'prefooter_section',

        )
    );

    $wp_customize->add_panel(
        'homepage_options',
        array(
            'title' => esc_html__('Home Page Options', 'flawless-recipe'),
            'priority' => 1,
        )
    );

    $wp_customize->add_section(
        'featured_recipe',
        array(
            'title' => esc_html__( 'Top Featured Recipes Slider','flawless-recipe' ),
            'panel'=>'homepage_options',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting(
        'flawless_recipe_theme_options[featured_recipe_category]',
        [
            'type' => 'option',
            'sanitize_callback' => 'flawless_recipe_sanitize_select',
  
        ]
    );

    $wp_customize->add_control(
        'flawless_recipe_theme_options[featured_recipe_category]',
        [
            'section' => 'featured_recipe',
            'type' => 'select',
            'choices' => flawless_recipe_get_categories_select(),
            'label' => esc_html__('Select Category to show Featured Recipes', 'flawless-recipe'),
            'description' => esc_html__('Only 4 Recipe posts will be shown in free version', 'flawless-recipe'),
            'settings' => 'flawless_recipe_theme_options[featured_recipe_category]',
            'priority' => 1,
        ]
    );
    
    
    
    $wp_customize->add_section(
        'about_section',
        array(
            'title' => esc_html__( 'About Section','flawless-recipe' ),
            'panel'=>'homepage_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('flawless_recipe_theme_options[about_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $flawless_recipe_options['about_show'],
            'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('flawless_recipe_theme_options[about_show]',
        array(
            'label' => esc_html__('Show About Section', 'flawless-recipe'),
            'description' => esc_html__('"More About Me" Button in About section is only available in premium version', 'flawless-recipe'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'about_section',

        )
    );
	$wp_customize->add_setting('flawless_recipe_theme_options[about_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('about_title',
	    array(
	        'label' => esc_html__('About Title', 'flawless-recipe'),
	        'type' => 'text',
	        'section' => 'about_section',
	        'settings' => 'flawless_recipe_theme_options[about_title]',
	    )
	);

	$wp_customize->add_setting('flawless_recipe_theme_options[about_desc]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('about_desc',
	    array(
	        'label' => esc_html__('About Description', 'flawless-recipe'),
	        'type' => 'text',
	        'section' => 'about_section',
	        'settings' => 'flawless_recipe_theme_options[about_desc]',
	    )
	);

	$wp_customize->add_setting('flawless_recipe_theme_options[about_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'flawless_recipe_theme_options[about_bg_image]',
	        array(
	            'label' => esc_html__('Add Image', 'flawless-recipe'),
	            'section' => 'about_section',
	            'settings' => 'flawless_recipe_theme_options[about_bg_image]',
	        ))
	);

	
	
	$wp_customize->add_section(
        '2column_recipe',
        array(
            'title' => esc_html__( 'Two Column Section','flawless-recipe' ),
            'panel'=>'homepage_options',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting('flawless_recipe_theme_options[2column_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $flawless_recipe_options['2column_show'],
            'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('flawless_recipe_theme_options[2column_show]',
        array(
            'label' => esc_html__('Show Section?', 'flawless-recipe'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => '2column_recipe',

        )
    );
    $wp_customize->add_setting('flawless_recipe_theme_options[section_title1]',
    array(
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('section_title1',
    array(
        'label' => esc_html__('Section Title 1', 'flawless-recipe'),
        'type' => 'text',
        'section' => '2column_recipe',
        'settings' => 'flawless_recipe_theme_options[section_title1]',
    )
);
$wp_customize->add_setting(
    'flawless_recipe_theme_options[small_recipe_grid]',
    [
        'type' => 'option',
        'sanitize_callback' => 'flawless_recipe_sanitize_select',

    ]
);

$wp_customize->add_control(
    'flawless_recipe_theme_options[small_recipe_grid]',
    [
        'section' => '2column_recipe',
        'type' => 'select',
        'choices' => flawless_recipe_get_categories_select(),
        'label' => esc_html__('Select Category to show Recipes', 'flawless-recipe'),
        'description' => esc_html__('Only 4 Recipe posts will be shown in free version', 'flawless-recipe'),
        'settings' => 'flawless_recipe_theme_options[small_recipe_grid]',

    ]
);


    $wp_customize->add_setting('flawless_recipe_theme_options[section_title2]',
    array(
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('section_title2',
    array(
        'label' => esc_html__('Section Title 2', 'flawless-recipe'),
        'type' => 'text',
        'section' => '2column_recipe',
        'settings' => 'flawless_recipe_theme_options[section_title2]',
    )
);

$wp_customize->add_setting(
    'flawless_recipe_theme_options[big_recipe_grid]',
    [
        'type' => 'option',
        'sanitize_callback' => 'flawless_recipe_sanitize_select',

    ]
);

$wp_customize->add_control(
    'flawless_recipe_theme_options[big_recipe_grid]',
    [
        'section' => '2column_recipe',
        'type' => 'select',
        'choices' => flawless_recipe_get_categories_select(),
        'label' => esc_html__('Select Category to show Recipes', 'flawless-recipe'),
        'description' => esc_html__('Only 4 Recipe posts will be shown in free version', 'flawless-recipe'),
        'settings' => 'flawless_recipe_theme_options[big_recipe_grid]',

    ]
);

$wp_customize->add_section(
    'last_column_recipe',
    array(
        'title' => esc_html__( 'Last Recipe Column ','flawless-recipe' ),
        'panel'=>'homepage_options',
        'capability'=>'edit_theme_options',
    )
);

$wp_customize->add_setting('flawless_recipe_theme_options[last_column_show]',
    array(
        'type' => 'option',
        'default'        => true,
        'default' => $flawless_recipe_options['last_column_show'],
        'sanitize_callback' => 'flawless_recipe_sanitize_checkbox',
    )
);

$wp_customize->add_control('flawless_recipe_theme_options[last_column_show]',
    array(
        'label' => esc_html__('Show Section?', 'flawless-recipe'),
        'type' => 'Checkbox',
        'priority' => 1,
        'section' => 'last_column_recipe',

    )
);

$wp_customize->add_setting('flawless_recipe_theme_options[last_section_title]',
array(
    'type' => 'option',
    'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control('last_section_title',
array(
    'label' => esc_html__('Section Title', 'flawless-recipe'),
    'type' => 'text',
    'section' => 'last_column_recipe',
    'settings' => 'flawless_recipe_theme_options[last_section_title]',
)
);

$wp_customize->add_setting(
'flawless_recipe_theme_options[last_recipe_column]',
[
    'type' => 'option',
    'sanitize_callback' => 'flawless_recipe_sanitize_select',

]
);

$wp_customize->add_control(
'flawless_recipe_theme_options[last_recipe_column]',
[
    'section' => 'last_column_recipe',
    'type' => 'select',
    'choices' => flawless_recipe_get_categories_select(),
    'label' => esc_html__('Select Category to show Recipes', 'flawless-recipe'),
    'description' => esc_html__('Only 4 Recipe posts will be shown in free version', 'flawless-recipe'),
    'settings' => 'flawless_recipe_theme_options[last_recipe_column]',

]
);
}
add_action( 'customize_register', 'flawless_recipe_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function flawless_recipe_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function flawless_recipe_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flawless_recipe_customize_preview_js() {
	wp_enqueue_script( 'flawless-recipe-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'flawless_recipe_customize_preview_js' );
