<?php
/**
 * Custom static control for use in Theme Customizer
 *
 * This is used to place plain text together with a label instead of a form input control.
 *
 * @see     http://getbootstrap.com/css/#forms on "Static Control" for naming
 * @package ZnWP Bootstrap Theme
 */

class ZnWP_Bootstrap_Theme_Customizer_Static_Control extends WP_Customize_Control
{
    /**
     * Defined in WP_Customize_Control; Render the control's content
     *
     * @see    wp-includes\class-wp-customize-control.php::render_content()
     * @return void
     */
    public function render_content()
    {
        printf(
            '<label>
               <span class="customize-control-title">%s</span>
               <div class="form-control-static" %s>%s</div>
             </label>',
            esc_html($this->label),
            $this->get_link(),
            $this->value()
        );
    }
}
