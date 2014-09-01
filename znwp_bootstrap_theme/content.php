<?php
/**
 * Default template for displaying post content
 *
 * @package ZnWP Bootstrap Theme
 */

global $znwp_theme;
?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <h1 class="post-title">
                <?php if (is_single()): ?>
                  <?php the_title(); ?>
                <?php else: ?>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php endif; ?>
              </h1>
              <time><span class="glyphicon glyphicon-time"></span> <?php the_date(); ?></time>
              <hr class="title-divider" />
              <?php if (is_single()): ?>
                <?php the_content(); ?>
                <br />
                <?php
                previous_post_link(
                    '<div class="link-block post-prev">%link</div>',
                    '<span class="glyphicon glyphicon-chevron-left"></span> %title'
                );
                next_post_link(
                    '<div class="link-block post-next">%link</div>',
                    '%title <span class="glyphicon glyphicon-chevron-right"></span>'
                );
                ?>
                <div class="clearfix"></div>
              <?php else: ?>
                <?php the_excerpt(); ?>
              <?php endif; ?>
            </article>
