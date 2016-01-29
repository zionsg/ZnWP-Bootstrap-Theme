<?php
/**
 * Main template file
 *
 * Other template files that call get_header(), get_sidebar() and get_footer()
 * are placed in ./template/ with the calls removed to provide content only
 * for inclusion here.
 *
 * @package ZnWP Bootstrap Theme
 */

$other_template_dir = 'template';
$other_templates = array( // <template> => <loop thru posts>
    '404' => false,
    'author' => true,
    'category' => true,
    'page' => false,
    'search' => true,
    'tag' => true,
    'archive' => true, // an archive is a category, tag, author or date based page - most generic, hence check last
);

get_header();
?>

<?php
$show_posts = true;
foreach ($other_templates as $other_template => $show_posts_flag) {
    $is_template = "is_{$other_template}";
    if ($is_template()) {
        get_template_part("{$other_template_dir}/{$other_template}");
        $show_posts = $show_posts_flag;
        break;
    }
}

if ($show_posts) {
    if (!have_posts()) {
        get_template_part('content', 'none');
    } else {
        while (have_posts()) {
            the_post();
            get_template_part('content', get_post_format()); // include the post format-specific template for the content
        }

        printf(
            '<br><div class="row"><div class="col-xs-6">%s</div><div class="col-xs-6 text-right">%s</div></div>',
            get_next_posts_link('« Older Posts'),
            get_previous_posts_link('Newer Posts »')
        );
    }
}
?>

<?php
get_footer();
