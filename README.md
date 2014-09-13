##ZnWP Bootstrap Theme

A no-frills theme using Twitter Bootstrap 3 for responsive layout and the Theme Customizer for settings.

### Installation
Steps
  - Click the "Download Zip" button on the righthand side of this GitHub page
  - Uncompress the zip file on your desktop
  - Copy the `znwp_bootstrap_theme` folder to your WordPress themes folder
    OR compress that folder and upload via the WordPress admin interface
  - Activate the theme

### Customization
Once activated, the theme can be customized via the Appearance > Customize admin screen.

### Action Hooks
  * `znwp_bootstrap_theme_post_init` - This is run after the theme has initialized. Child themes can modify functionality via this.

### Filter Hooks
  * `znwp_bootstrap_theme_version` - This is mainly used to version enqueued styles and scripts.
