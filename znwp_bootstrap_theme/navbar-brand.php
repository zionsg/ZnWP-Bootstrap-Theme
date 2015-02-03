<?php
/**
 * Navbar brand template
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

              <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                $brand = $znwp_theme->theme_mod('navbar_brand');
                if ('home-icon' == $brand) {
                    echo '<span class="glyphicon glyphicon-home"></span>';
                } elseif ('site-title' == $brand) {
                    bloginfo('name');
                } elseif ('none' == $brand) {
                    // Show nothing
                }
                ?>
              </a>
