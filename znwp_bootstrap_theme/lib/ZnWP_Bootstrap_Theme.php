<?php
/**
 * Theme functions
 *
 * Order of methods generally follows that of init().
 * Filter hooks: znwp_bootstrap_theme_version
 * Action hooks: znwp_bootstrap_theme_post_init
 *
 * @see     https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
 * @package ZnWP Bootstrap Theme
 */

class ZnWP_Bootstrap_Theme
{
    /**
     * Theme version
     *
     * Not a constant so as to allow child theme to override using filter hook.
     * Static as all instances should share the same version.
     *
     * @see http://semver.org/
     * @var string
     */
    protected static $version = '1.0.0+20140825T2100';

    /**
     * Class files for custom Theme Customizer controls
     *
     * WP_Customize_Control is only loaded when the Theme Customizer is used, so custom controls
     * can only be loaded in customize_register().
     *
     * The class files must reside in the same directory as this class. File extension must be provided.
     *
     * @var array
     */
    protected $customizer_controls = array('ZnWP_Bootstrap_Theme_Customizer_Static_Control.php');

    /**
     * No. of columns in Twitter Bootstrap grid
     *
     * @var int
     */
    protected $grid_columns = 12;

    /**
     * Theme modification settings and corresponding defaults
     *
     * Order follows that of layout as in customize_register().
     *
     * @var array
     */
    protected $settings = array(
        'header_textcolor' => '#000',
        'disable_layout' => false,
        'display_header' => true,
        'header_height'  => 150, // in pixels
        'grid_class_prefix' => 'col-sm-',
        'navbar_brand' => 'home-icon',
        'sidebar_columns'  => 3,
        'sidebar_location' => 'right',
        'footer_text' => 'Copyright 2014, <a href="http://intzone.com/">intZone.com</a>',
        'login_form_logo' => '',
    );

    /**
     * Initialize theme
     *
     * @return void
     */
    public function init()
    {
        self::$version = apply_filters('znwp_bootstrap_theme_version', self::$version);

        // Modify login form
        add_action('login_enqueue_scripts', array($this, 'modify_login_form'));

        // Modify HTTP headers and <head>
        $this->modify_http_headers_head();

        // Enqueue styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles_scripts'));

        // Register support of theme features including menus and editor style
        $this->theme_support();

        // Add theme settings to Theme Customizer
        add_action('customize_register', array($this, 'customize_register'));
        add_action('customize_controls_print_styles', array($this, 'customize_css'));

        // Register sidebar and widgets
        $this->register_sidebar_widgets();

        // Add CSS class to navigation menu item
        add_filter('nav_menu_css_class', array($this, 'add_nav_class'), 10, 2);

        // Modify post formatting
        add_filter('excerpt_more', array($this, 'modify_excerpt_more'));

        // Action hook for child themes to do additional initialization
        do_action('znwp_bootstrap_theme_post_init');
    }

    /**
     * Get theme version
     *
     * @return string
     */
    public function get_version()
    {
        return self::$version;
    }

    /**
     * Modify login form
     *
     * @return void
     */
    public function modify_login_form()
    {
        add_filter('login_headerurl', function ($result) { return get_home_url(); });
        add_filter('login_headertitle', function ($result) { return get_option('blogname'); });
        wp_enqueue_style('login-styles', get_stylesheet_uri()); // load theme stylesheet in login screen

        $logo = $this->theme_mod('login_form_logo');
        if ($logo) {
            printf(
                '<style id="login-form-css">
                   body.login div#login h1 a { background-image: url(%s); }
                 </style>',
                $logo
            );
        }
    }

    /**
     * Modify HTTP headers and <head>
     *
     * @see    http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
     * @return void
     */
    public function modify_http_headers_head()
    {
        add_filter('wp_headers', array($this, 'remove_header_pingback'));
        add_action('wp_head', array($this, 'add_head_ie_support'));

        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_shortlink_wp_head');
    }

    /**
     * Remove pingback header
     *
     * @param  array $headers
     * @return array
     */
    public function remove_header_pingback($headers)
    {
        unset($headers['X-Pingback']);
        return $headers;
    }

    /**
     * Add HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries
     *
     * @return void
     */
    public function add_head_ie_support()
    {
        $uri = esc_url(get_template_directory_uri());
        echo '<!--[if lt IE 9]>'. "\n",
             '<script src="' . "{$uri}/inc/js/html5shiv.min.js" . '"></script>'. "\n",
             '<script src="' . "{$uri}/inc/js/respond.min.js" . '"></script>'. "\n",
             '<![endif]-->' . "\n";
    }

    /**
     * Enqueue styles and scripts
     *
     * $version is used instead of filemtime() for versioning of files for performance reasons.
     *
     * @see    http://codex.wordpress.org/Function_Reference/wp_enqueue_style
     * @see    http://codex.wordpress.org/Function_Reference/wp_enqueue_script
     * @return void
     */
    public function enqueue_styles_scripts()
    {
        $uri = get_template_directory_uri() . '/inc/bootstrap';
        $version = $this->get_version();

        wp_enqueue_style('znwp-bootstrap-theme-bootstrap-css', "{$uri}/css/bootstrap.min.css", array(), $version);
        wp_enqueue_style('znwp-bootstrap-theme-style', get_stylesheet_uri(), array(), $version);
        wp_enqueue_script(
            'znwp-bootstrap-theme-bootstrap-js',
            "{$uri}/js/bootstrap.min.js",
            array('jquery'),
            $version,
            true // load script in footer
        );
    }

    /**
     * Register support of theme features including menus and editor style
     *
     * @see    http://codex.wordpress.org/Function_Reference/add_theme_support
     * @return void
     */
    public function theme_support()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('custom-background', array('default-color' => '#fff'));
        add_theme_support('custom-header', array(
            'default-text-color' => '#333',
            'flex-width'         => true,
            'width'              => '1920', // this must be set else 'Select and Crop' will not work when uploading
            'flex-height'        => true,
            'height'             => $this->theme_mod('header_height'),
            'wp-head-callback'   => array($this, 'custom_header_callback'),
        ));
        add_theme_support('html5');

        // Without register_nav_menus(), the Navigation section in Theme Customizer will not appear
        add_theme_support('menus');
        register_nav_menus(array(
            'primary' => 'Primary menu in navigation bar',
            // 'secondary' => 'Secondary menu in sidebar', // the Custom Menu widget is more flexible wrt positioning
        ));

        // This theme styles the visual editor to resemble the theme style
        add_editor_style('editor-style.css');
    }

    /**
     * Custom header callback
     *
     * @return void
     */
    public function custom_header_callback()
    {
        $background = set_url_scheme(get_header_image());
        $color = $this->theme_mod('header_textcolor');

        if (!$background && !$color) {
            return;
        }

        $height = $this->theme_mod('header_height');
        $style = "height: {$height}px;";
        if ($background) {
            $image = " background-image: url('{$background}');";
            $style .= $image . " background-size: 100% {$height}px;";
        }

        printf(
            '<style type="text/css" id="custom-header-css">
               header.custom-header { %s }
               header.custom-header #header-text {
                  color: %s;
                  margin-top: %spx;
               }
             </style>' . PHP_EOL,
            trim($style),
            "#{$color}",
            ($height / 3)
        );
    }

    /**
     * Add theme settings to Theme Customizer
     *
     * @see    http://codex.wordpress.org/Theme_Customization_API
     * @see    http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
     * @see    http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
     * @see    http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     * @param  WP_Customize_Manager $wp_customize
     * @return void
     */
    public function customize_register($wp_customize)
    {
        // Load custom controls
        foreach ($this->customizer_controls as $file) {
            include $file;
        }

        // Add settings
        foreach ($this->settings as $setting => $default) {
            $wp_customize->add_setting($setting, array(
                'default' => $default,
                'sanitize_callback' => ('header_height' == $setting ? array($this, 'sanitizer_int') : ''),
            ));
        }

        // Add sections
        $priority = 200; // put new theme sections after default sections
        $wp_customize->add_section('login-form', array(
            'title' => 'Login Form',
            'description' => 'Customize the login form.',
            'priority' => $priority++,
        ));
        $wp_customize->add_section('layout', array(
            'title' => 'Layout',
            'description' => 'Layout uses Twitter Bootstrap 3 which has 12 columns per row in its grid system.',
            'priority' => $priority++,
        ));

        // Add form controls for Layout section
        $priority = 1; // if not set, controls may sometimes jump around
        $wp_customize->add_control('disable_layout', array(
            'label' => 'Disable layout (including styles/scripts) to allow embedding of blog in another site',
            'section' => 'layout',
            'type' => 'checkbox',
            'priority' => $priority++,
        ));
        $wp_customize->add_control('display_header', array(
            'label' => 'Display header',
            'section' => 'layout',
            'type' => 'checkbox',
            'priority' => $priority++,
        ));
        $wp_customize->add_control('header_height', array(
            'label' => 'Header height in pixels',
            'section' => 'layout',
            'type' => 'text',
            'priority' => $priority++,
        ));
        $choices = array('col-xs-', 'col-sm-', 'col-md-', 'col-lg-');
        $wp_customize->add_control('grid_class_prefix', array(
            'label' => 'Grid class prefix (determines breakpoint for responsive layout)',
            'section' => 'layout',
            'type' => 'select',
            'choices' => array_combine($choices, $choices), // keys same as values
            'priority' => $priority++,
        ));
        $choices = array('home-icon' => 'Home Icon', 'site-title' => 'Site Title');
        $wp_customize->add_control('navbar_brand', array(
            'label' => 'Navbar Branding',
            'section' => 'layout',
            'type' => 'select',
            'choices' => $choices,
            'priority' => $priority++,
        ));
        $choices = array(2, 3, 4, 6);
        $wp_customize->add_control('sidebar_columns', array(
            'label' => 'No. of grid columns to use for sidebar',
            'section' => 'layout',
            'type' => 'select',
            'choices' => array_combine($choices, $choices), // keys same as values
            'priority' => $priority++,
        ));
        $choices = array('left', 'right', 'none');
        $wp_customize->add_control('sidebar_location', array(
            'label' => 'Sidebar location',
            'section' => 'layout',
            'type' => 'select',
            'choices' => array_combine($choices, $choices), // keys same as values
            'priority' => $priority++,
        ));
        $wp_customize->add_control('footer_text', array(
            'label' => 'Footer text',
            'section' => 'layout',
            'type' => 'text',
            'priority' => $priority++,
        ));

        // Add form controls for Login Form section
        $priority = 1;
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            'login_form_logo',
            array(
                'label'    => 'Upload a logo to use for the login form (recommended: 150 x 150 pixels)',
                'section'  => 'login-form',
                'priority' => $priority++,
            )
        ));
    }

    /**
     * Custom CSS for Theme Customizer
     *
     * @return void
     */
    public function customize_css()
    {
        echo '
            <style>
              .accordion-section #customize-control-login_form_logo.customize-control-image .preview-thumbnail img {
                max-height: 150px;
                max-width: 150px;
              }
            </style>
        ';
    }

    /**
     * Sanitizer for integers
     *
     * @param  mixed $value
     * @return int
     */
    public function sanitizer_int($value)
    {
        return (int) $value;
    }

    /**
     * Get theme modification setting
     *
     * This provides the theme default value as fallback if the setting has not been saved
     * by the user in the Theme Customizer.
     *
     * @see    http://codex.wordpress.org/Function_Reference/get_theme_mod
     * @param  string $setting   Setting to get
     * @return mixed
     */
    public function theme_mod($setting)
    {
        return get_theme_mod($setting, isset($this->settings[$setting]) ? $this->settings[$setting] : '');
    }

    /**
     * Get CSS class for full width column
     *
     * @return string
     */
    public function get_full_width_class()
    {
       return $this->theme_mod('grid_class_prefix') . $this->grid_columns;
    }

    /**
     * Get CSS class for half width column
     *
     * @return string
     */
    public function get_half_width_class()
    {
       return $this->theme_mod('grid_class_prefix') . intval($this->grid_columns / 2);
    }

    /**
     * Get CSS class for header
     *
     * @return string
     */
    public function get_header_class()
    {
        if (get_theme_mod('header_textcolor') || get_header_image()) {
            return 'custom-header';
        }
    }

    /**
     * Whether to display header text
     *
     * WP_Customize_Manager adds a 'Display Header Text' checkbox under 'Site Title & Tagline' section
     * which reuses the 'header_textcolor' setting and sets the value to 'blank'.
     *
     * @see    wp-includes\class-wp-customize-manager.php:register_controls()
     * @return bool
     */
    public function display_header_text()
    {
        $value = get_theme_mod('header_textcolor');
        return ($value && $value != 'blank') ? true : false;
    }

    /**
     * Compute no. of columns to use for sidebar taking into account sidebar location
     *
     * @return int
     */
    public function get_sidebar_columns()
    {
        if (!in_array($this->theme_mod('sidebar_location'), array('left', 'right'))) {
            return 0;
        } else {
            return $this->theme_mod('sidebar_columns');
        }
    }

    /**
     * Get CSS class for main section
     *
     * @return string
     */
    public function get_main_class()
    {
        return $this->theme_mod('grid_class_prefix')
             . ($this->grid_columns - $this->get_sidebar_columns());
    }

    /**
     * Get CSS class for sidebar section
     *
     * @return string
     */
    public function get_sidebar_class()
    {
        return $this->theme_mod('grid_class_prefix') . $this->get_sidebar_columns();
    }

    /**
     * Register sidebar and widgets
     *
     * @return void
     */
    public function register_sidebar_widgets()
    {
        register_sidebar(array(
            'name'          => 'Sidebar',
            'id'            => 'sidebar',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
    }

    /**
     * Add CSS class to navigation menu item
     *
     * @return array
     */
    public function add_nav_class($classes)
    {
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active ';
        }

        return $classes;
    }

    /**
     * Modify excerpt more text
     *
     * @param  string $more
     * @return string
     */
    public function modify_excerpt_more($more)
    {
        return sprintf(
            '<div class="link-block read-more">
               <a href="%s">%s <span class="glyphicon glyphicon-chevron-right"></span></a>
             </div><div class="clearfix"></div>',
            get_permalink(get_the_ID()),
            'Continue reading'
        );
    }
}
