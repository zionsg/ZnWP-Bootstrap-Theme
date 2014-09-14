<?php
/**
 * Header top template
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

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
