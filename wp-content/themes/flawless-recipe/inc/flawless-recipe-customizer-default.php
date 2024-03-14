<?php
if (!function_exists('flawless_recipe_theme_options')) :
    function flawless_recipe_theme_options()
    {
        $defaults = array(

            //banner section
            'facebook' => '',
            'twitter' => '',
            'site_title_show' => 1,
            
            'show_image' => 1,
            'show_blog_author' => 1,
            'show_blog_date' => 1,
            'show_excerpts' => 0,
            
            'show_single_sidebar' => 1,
            'show_preloader' => 1,


            'show_prefooter' => 1,
            'featured_recipe_category' => "",
            'about_show' => 0,
            'about_title' => '',
            'about_desc' => '',
            'about_bg_image' => '',
            
            'small_recipe_grid' => '',
            'big_recipe_grid' => '',
            
            'section_title1' => '',
            'section_title2' => '',
            
            '2column_show' => 1,
            'last_column_show' => 1,
            'last_section_title' => '',
            'last_recipe_column' => '',

        );

        $options = get_option('flawless_recipe_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
