<?php
$flawless_recipe_options = flawless_recipe_theme_options();
$about_show            = $flawless_recipe_options['about_show'];
$about_title           = $flawless_recipe_options['about_title'];
$about_desc           = $flawless_recipe_options['about_desc'];
$about_bg_image  = $flawless_recipe_options['about_bg_image'];



if($about_show == 1){   ?>

    <div class="section about-section">
        <div class="container">
            <div class="row">

                    <div class="col-md-6">
                        <img src="<?php echo esc_url($about_bg_image); ?>" alt="" />
                    </div>
                    
                     <div class="col-md-6">
                        <div class="about-wrap">
                            <h2><?php echo esc_html($about_title); ?></h2>
                            <p><?php echo esc_html($about_desc); ?></p>
                            
                        </div>
                     </div>
                   
            </div>
        </div>
    </div>

<?php } ?>