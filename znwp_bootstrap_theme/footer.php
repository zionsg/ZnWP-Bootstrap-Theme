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

<?php if (!$znwp_theme->theme_mod('disable_layout')): ?>
      </div> <!-- end container -->

      <footer>
        <br />
        <hr />
        <div class="container">
          <div class="row">
            <div id="footer-text" class="<?php echo $znwp_theme->get_full_width_class(); ?>">
              <?php echo $znwp_theme->theme_mod('footer_text'); ?>
            </div>
          </div>
        </div>
      </footer>

      <?php wp_footer(); ?>
      <p>&nbsp;</p>
    </body>
  </html>
<?php endif; ?>
