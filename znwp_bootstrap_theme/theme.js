/**
 * Inline scripts for theme
 *
 * @package ZnWP Bootstrap Theme
 */

jQuery(document).ready(function ($) {
    // Enable 2-level navigation using Bootstrap classes
    $('li.menu-item-has-children > ul').each(function () {
        $(this).addClass('dropdown-menu');
    });
    $('li.menu-item-has-children > a').each(function () {
        $(this).attr('href', '#');
        $(this).attr('data-toggle', 'dropdown').addClass('dropdown-toggle');
        $(this).html($(this).html() + ' <span class="caret"></span>');
    });
});
