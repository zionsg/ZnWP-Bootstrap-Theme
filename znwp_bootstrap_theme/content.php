<?php
/**
 * Default template for displaying post content
 *
 * @package ZnWP Bootstrap Theme
 */
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
                <?php
                the_content();
                get_template_part('postlinks');
                ?>
              <?php else: ?>
                <?php the_excerpt(); ?>
              <?php endif; ?>
            </article>
