<?php
/**
 * Navigation template
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

        <div class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header">
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
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <nav class="collapse navbar-collapse" role="navigation">
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
            </nav>
          </div>
        </div>
