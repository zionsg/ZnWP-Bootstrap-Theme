<?php
/**
 * Theme functions
 *
 * @package ZnWP Bootstrap Theme
 */

// PSR-1 states that files should not declare classes and execute code
require get_template_directory() . '/lib/ZnWP_Bootstrap_Theme.php';

$znwp_theme = ZnWP_Bootstrap_Theme::getInstance();
$znwp_theme->init();
