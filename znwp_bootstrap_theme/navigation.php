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
              <?php
              get_template_part('navbar-brand');
              get_template_part('navbar-toggle');
              ?>
            </div>

            <nav class="collapse navbar-collapse" role="navigation">
              <?php get_template_part('navbar-menu'); ?>
            </nav>
          </div>
        </div>
