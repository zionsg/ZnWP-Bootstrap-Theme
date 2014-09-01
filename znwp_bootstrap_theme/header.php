<?php
/**
 * Header template
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
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
          <div class="container">
            <div class="row">
              <div class="<?php echo $znwp_theme->get_full_width_class(); ?>">
                <?php if ($znwp_theme->display_header_text()): ?>
                  <div id="header-text">
                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                    <div class="tagline"><?php bloginfo('description'); ?></div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </header>
      <?php endif; ?>

      <?php
      get_template_part('navigation');
      get_template_part('slideshow');
      ?>

      <div class="container">
<?php endif; ?>

        <div id="content" class="row">
          <?php get_template_part('sidebar', 'left'); ?>

          <main id="main" class="<?php echo $znwp_theme->get_main_class(); ?>" role="main">
