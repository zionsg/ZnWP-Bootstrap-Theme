<?php
/**
 * Navbar menu template
 *
 * @package ZnWP Bootstrap Theme
 */
?>

              <?php
              // Output only if navigation menu is set
              if (has_nav_menu('primary')) {
                  wp_nav_menu(array(
                      'theme_location' => 'primary',
                      'container'      => false,
                      'menu_class'     => 'nav navbar-nav',
                  ));
              }
              ?>
