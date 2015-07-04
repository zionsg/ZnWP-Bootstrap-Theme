<?php
/**
 * Post links template
 *
 * To link only to posts of the same category, pass in boolean true as the 3rd argument.
 *
 * @package ZnWP Bootstrap Theme
 */
?>

                <br />
                <div class="post-links">
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
                </div>
