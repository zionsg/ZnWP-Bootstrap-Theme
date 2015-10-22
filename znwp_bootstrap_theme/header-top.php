<?php
/**
 * Header top template
 *
 * @package ZnWP Bootstrap Theme
 */

$znwp_theme = ZnWP_Bootstrap_Theme::getInstance();
?>

          <div class="container">
            <div class="row">
              <div class="<?php echo $znwp_theme->get_full_width_class(); ?>">
                <?php if ($znwp_theme->display_header_text()): ?>
                  <div id="header-text">
                    <div class="site-title"><?php bloginfo('name'); ?></div>
                    <div class="tagline"><?php bloginfo('description'); ?></div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
