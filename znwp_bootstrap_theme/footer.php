<?php
/**
 * Footer template
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

          </main>

          <?php get_template_part('sidebar', 'right'); ?>
        </div> <!-- end row -->

        <?php
        // Load wp_footer if in Theme Customizer preview and layout is disabled
        if (!empty($GLOBALS['wp_customize']) && $znwp_theme->theme_mod('disable_layout')) {
            wp_footer();
        }
        ?>

<?php if (!$znwp_theme->theme_mod('disable_layout')): ?>
      </div> <!-- end container -->

      <footer>
        <?php get_template_part('footer', 'bottom'); ?>
      </footer>

      <?php wp_footer(); ?>
    </body>
  </html>
<?php endif; ?>
