<?php
/**
 * Theme functions
 *
 * @package ZnWP Bootstrap Theme
 */

// PSR-1 states that files should not declare classes and execute code
require get_template_directory() . '/lib/ZnWP_Bootstrap_Theme.php';

$znwp_theme = new ZnWP_Bootstrap_Theme(); // short and likely unique variable name for global usage
$znwp_theme->init();
