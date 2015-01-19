<?php
/**
 * Child theme functions
 *
 * @package ZnWP Bootstrap Theme
 */

add_filter('znwp_bootstrap_theme_version', function ($version) { return time(); });

add_action('znwp_bootstrap_theme_post_init', function ($parent_theme) {
    // Additional styles & scripts
    $uri = get_stylesheet_directory_uri();
    $version = $parent_theme->get_version();
    wp_enqueue_script(
        'child-theme-js',
        "{$uri}/child-theme.js",
        array('znwp-bootstrap-theme-js'),
        $version,
        true // load script in footer
    );
});

/**
 * Get posts and custom fields indexed by post ID
 *
 * Each post will have an added 'custom_fields' property.
 *
 * @param  array $defaults Default values for custom fields - also used as type hint for custom field
 * @param  array $params   Additional WP_Query params - http://codex.wordpress.org/Class_Reference/WP_Query#Parameters
 * @return WP_Post[]
 */
function get_posts_with_custom_fields(array $defaults = array(), array $params = array())
{
    $result = array();
    $params = array_merge(
        array(
            'post_type' => 'post',
            'posts_per_page' => -1, // get all posts
        ),
        $params
    );

    $posts = get_posts($params);
    foreach ($posts as $post) {
        $post->custom_fields = array();

        // Ensure all fields listed in $defaults are set
        $post_custom = array_merge($defaults, get_post_custom($post->ID));
        foreach ($post_custom as $key => $value) {
            // get_post_custom() returns array for each meta key - implode value if default is not array but value is
            if (isset($defaults[$key]) && !is_array($defaults[$key]) && is_array($value)) {
                $value = implode('', $value);
            }
            $post->custom_fields[$key] = $value;
        }

        $result[$post->ID] = $post;
    }

    return $result;
}
