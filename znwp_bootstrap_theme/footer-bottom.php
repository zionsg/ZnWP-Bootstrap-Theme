<?php
/**
 * Footer bottom template
 *
 * @package ZnWP Bootstrap Theme
 */

$znwp_theme = ZnWP_Bootstrap_Theme::getInstance();
?>

        <br />
        <hr />
        <div class="container">
          <div class="row">
            <div id="footer-text" class="<?php echo $znwp_theme->get_full_width_class(); ?>">
              <?php echo $znwp_theme->theme_mod('footer_text'); ?>
            </div>
          </div>
        </div>
        <p>&nbsp;</p>
