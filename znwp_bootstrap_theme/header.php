<?php
/**
 * Header template
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;

$full_width_content = $znwp_theme->theme_mod('full_width_content');
?>
<?php if (!$znwp_theme->theme_mod('disable_layout')): ?>
  <!DOCTYPE html>
  <html <?php language_attributes(); ?>>

    <head>
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php wp_title('|', true, 'right') . bloginfo('name'); ?></title>
      <?php wp_head(); // style.css loaded via here ?>
    </head>

    <body <?php body_class(); ?>>
      <a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>

      <?php if ($znwp_theme->theme_mod('display_header')): ?>
        <header class="<?php echo $znwp_theme->get_header_class(); ?>">
          <?php get_template_part('header', 'top'); ?>
        </header>
      <?php endif; ?>

      <?php
      echo (!$znwp_theme->theme_mod('full_width_navbar') ? '<div class="container">' . "\n" : '');
      get_template_part('navigation');
      get_template_part('slideshow');
      echo (!$znwp_theme->theme_mod('full_width_navbar') ? "\n" . '</div>' : '');
      ?>

      <div class="container<?php echo ($full_width_content ? '-fluid' : ''); ?>">
<?php endif; ?>

        <?php
        // Load wp_head if in Theme Customizer preview and layout is disabled
        if (!empty($GLOBALS['wp_customize']) && $znwp_theme->theme_mod('disable_layout')) {
            wp_head();
        }
        ?>

        <div id="content" class="row">
          <?php get_template_part('sidebar', 'left'); ?>

          <main id="main" class="<?php echo ($full_width_content ? '' : $znwp_theme->get_main_class()); ?>" role="main">
            <!-- no col-*-12 class for full width content else will have extra padding at the sides -->
