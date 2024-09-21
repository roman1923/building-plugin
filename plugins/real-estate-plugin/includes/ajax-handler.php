<?php

class RealEstateQueryModifier {

    public function __construct() {
        add_action('pre_get_posts', array($this, 'modify_real_estate_query'));
    }

    public function modify_real_estate_query($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('real_estate_object')) {
            // Sort posts by "екологічність" (environmental rating) in descending order
            $query->set('meta_key', 'environmental_rating');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'DESC');
        }
    }
}

// Initialize the class to modify queries
new RealEstateQueryModifier();


// AJAX handler for filtering real estate objects
function filter_real_estate_objects() {
    // Parse filter data
    parse_str($_POST['filter'], $filters);

    // Define a query to find the most identical match
    $args = array(
        'post_type' => 'real_estate_object',
        'posts_per_page' => 1,
        'meta_query' => array(
            'relation' => 'AND',
        )
    );

    // Add filters for the identical post
    if (!empty($filters['building_name'])) {
        $args['meta_query'][] = array(
            'key' => 'building_name',
            'value' => $filters['building_name'],
            'compare' => 'LIKE'
        );
    }

    if (!empty($filters['number_of_floors'])) {
        $args['meta_query'][] = array(
            'key' => 'number_of_floors',
            'value' => $filters['number_of_floors'],
            'compare' => '='
        );
    }

    if (!empty($filters['building_type'])) {
        $args['meta_query'][] = array(
            'key' => 'building_type',
            'value' => $filters['building_type'],
            'compare' => '='
        );
    }

    if (!empty($filters['environmental_rating'])) {
        $args['meta_query'][] = array(
            'key' => 'environmental_rating',
            'value' => $filters['environmental_rating'],
            'compare' => '='
        );
    }

    $identical_query = new WP_Query($args);

    // Define a second query for similar posts
    $similar_args = array(
        'post_type' => 'real_estate_object',
        'posts_per_page' => 4,  // We'll show 4 additional similar posts
        'post__not_in' => wp_list_pluck($identical_query->posts, 'ID'),
        'meta_query' => array(
            'relation' => 'AND',
        ),
        'orderby' => array(
            'meta_value_num' => 'DESC'  // Sort by environmental_rating
        ),
        'meta_key' => 'environmental_rating'
    );

    $similar_query = new WP_Query($similar_args);

    // Display results
    if ($identical_query->have_posts()) {
        echo '<ul class="real-estate-results">';

        // Show the identical post with special background
        while ($identical_query->have_posts()) : $identical_query->the_post();
            ?>
            <li style="background-color: #e3e3e3;"> <!-- Special background for identical result -->
                <a href="<?php the_permalink(); ?>">
                    <h3><?php the_title(); ?></h3>
                    <?php $image = get_field('building_image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <p>
						<?php if (has_excerpt()) : ?>
							<?php the_excerpt(); ?>
						<?php else : ?>
							<?php echo wp_trim_words(get_the_content(), 15); ?>
						<?php endif; ?>
					</p>
                </a>
            </li>
            <?php
        endwhile;

        // Display similar posts sorted by "екологічність"
        if ($similar_query->have_posts()) {
            while ($similar_query->have_posts()) : $similar_query->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                        <?php $image = get_field('building_image'); ?>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                    </a>
                </li>
                <?php
            endwhile;
        }

        echo '</ul>';

    } else {
        echo '<p>Не знайдено об\'єктів нерухомості за вашими критеріями.</p>';
    }

    wp_die();
}
add_action('wp_ajax_filter_real_estate', 'filter_real_estate_objects');
add_action('wp_ajax_nopriv_filter_real_estate', 'filter_real_estate_objects');
