<?php
/**
 * Search form template
 *
 * @package ZnWP Bootstrap Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="form-group">
    <label for="s">Search for:</label>
    <input id="s" name="s" type="search" class="form-control" />
  </div>
  <input type="submit" class="btn btn-default" value="Search" />
</form>
