<?php
/**
 * Template for displaying sidebar on the left
 *
 * @package ZnWP Bootstrap Theme
 */

$znwp_theme = ZnWP_Bootstrap_Theme::getInstance();
?>

<?php
if ('left' == $znwp_theme->theme_mod('sidebar_location')) {
    get_template_part('sidebar', 'content');
}
