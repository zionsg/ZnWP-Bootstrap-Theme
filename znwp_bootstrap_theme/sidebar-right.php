<?php
/**
 * Template for displaying sidebar on the right
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

<?php
if ('right' == $znwp_theme->theme_mod('sidebar_location')) {
    get_template_part('sidebar', 'content');
}
