<?php
/**
 * Template for displaying sidebar contents
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

        <aside id="sidebar" class="<?php echo $znwp_theme->get_sidebar_class(); ?>" role="sidebar">
          <?php
          if (is_active_sidebar('sidebar')) {
              dynamic_sidebar('sidebar');
          }
          ?>
        </aside>
