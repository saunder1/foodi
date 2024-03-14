<?php
/**
Template Name: My Recipes
* @package Full Page
*/
get_header(); ?>
<div class="fullpage-maincontainer">
    <div class="farea">
        <?php get_sidebar('leftmenu'); ?>
        <div id="fullpage-content">
            <div class="container areadivide">
                <div class="page_content frontmanage">
                    <div class="fullwide-page-content">
                        <section id="sitefull">
                            <?php
                            /*
                            Template Name: My Recipes
                            */
                            // Check if the user is logged in
                            if (is_user_logged_in()) {
                                // Get the current user ID
                                $current_user_id = get_current_user_id();

                                // Get the user object
                                $current_user = get_user_by('ID', $current_user_id);

                                // Display the username in an h1 tag
                                echo '<h1>Welcome, ' . esc_html($current_user->user_login) . '</h1>';

                                // Define your custom query arguments
                                $args = array(
                                    'author' => $current_user_id,  // Show posts only from the current user
                                    'post_type' => 'post',            // Adjust post type as needed
                                    'posts_per_page' => -1,                // Display all posts from the user
                                );

                                // Create a new WP_Query instance with the custom arguments
                                $query = new WP_Query($args);

                                // Check if there are posts
                                if ($query->have_posts()) {
                                    echo '<div class="entry-cards-container">'; // Opening container for cards
                                    while ($query->have_posts()) {
                                        $query->the_post();
                            ?>

                                        <!-- Entry card starts -->
                                        <div class="entry-card">
                                            <!-- Front side of the card -->
                                            <div class="card-front">
                                                <!-- Post title as a clickable link -->
                                                <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                                                <!-- Post tags -->
                                                <?php $tags = get_the_tags();
                                                if ($tags) {
                                                ?>
                                                    <p class="tags">Tags:
                                                        <?php foreach ($tags as $tag) { ?>
                                                            <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
                                                        <?php } ?>
                                                    </p>
                                                <?php } ?>
                                                <div class="button-container front">
                                                    <button class="flip-button" onclick="flipCard(this)">Flip</button>
                                                </div>
                                            </div>
                                            
                                            <!-- Back side of the card -->
                                            <div class="card-back">
                                                <!-- Recipe description -->
                                                <p><?php echo get_the_excerpt(); ?></p>
                                                <div class="button-container back">
                                                    <button class="flip-button" onclick="flipCard(this)">Flip</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Entry card ends -->

                            <?php
                                    }
                                    echo '</div>'; // Closing container for cards
                                    // Restore original post data
                                    wp_reset_postdata();
                                } else {
                                    // Display a message if no posts are found
                                    echo 'No posts found.';
                                }
                            } else {
                                // Display a message if the user is not logged in
                                echo 'Please log in to view your posts.';
                            }
                            ?>

                        </section>
                    </div>
                </div>
            </div>
            <?php get_footer(); ?>

            <script>
                function flipCard(button) {
                    var card = button.closest('.entry-card');
                    card.classList.toggle('flip');
                }
            </script>
