<?php
/**
 * Archive template
 *
 * @package ZnWP Bootstrap Theme
 */

$title = '';
if (is_year()) {
    $title = get_query_var('year');
} elseif (is_month()) {
    $title = single_month_title(' ', false);
} elseif (is_day()) {
    $date = get_query_var('day') . single_month_title(' ', false);
    $title = date('d F Y', strtotime($date));
}
?>

              <h1 class="page-title">Archive: <?php echo trim($title); ?></h1>
