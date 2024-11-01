<?php
/*
Plugin Name: WP krpano
Plugin URI: http://wordpress.org/extend/plugins/wp-krpano/
Description: WP krpano allows to easily embed and display panoramic images in posts using the Adobe Flash based interactive panorama viewer krpano.
Version: 1.2.1
Author: Jens Remus
Author URI: http://www.no-nonsense.de/

    © Copyright 2010 Jens Remus (e-mail: jens.remus@gmx.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

define('WPKRPANO_VERSION', '1.2.1');
define('WPKRPANO_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('WPKRPANO_DIR', dirname(plugin_basename(__FILE__)));
define('WPKRPANO_URL', WP_PLUGIN_URL . WPKRPANO_DIR);
define('WPKRPANO_I18N_DOMAIN', 'wp-krpano');
define('WPKRPANO_OPTIONS', 'wp_krpano_options'); // settings name
define('WPKRPANO_SETTINGS_GROUP', 'wp_krpano_settings_group'); // settings group name
define('WPKRPANO_SETTINGS_PAGE', 'wp-krpano'); // settings page name
define('WPKRPANO_SHORTCODE', 'krpano');

// load translation (i18n)
load_plugin_textdomain(WPKRPANO_I18N_DOMAIN, WPKRPANO_DIR);

if (is_admin()) {
	/**
	 * WP Filter: plugin_action_links_$plugin
	 *
	 * This filter prepends a link to the plugin's settings/options page to the plugin's action link list.
	 *
	 * @param $links The plugin's action link list.
	 * @return The filtered plugin's action link list.
	 */
	function wpkrpano_plugin_action_links_filter($links) {
		// prepend link to the plugin's settings/options page
		array_unshift($links, '<a href="' . trailingslashit(admin_url()) . 'options-general.php?page=' . WPKRPANO_SETTINGS_PAGE .'">' . esc_html__('Settings') . '</a>');
		return $links;
	}
	add_filter('plugin_action_links_' . WPKRPANO_PLUGIN_BASENAME, 'wpkrpano_plugin_action_links_filter');

	/**
	 * WP Filter: plugin_row_meta
	 *
	 * This filter appends a link to the krpano homepage to the plugin's meta link list.
	 *
	 * @param $links The plugin's meta link list.
	 * @param $file The plugin's base file name.
	 * @return The filtered plugin's meta link list.
	 */
	function wpkrpano_plugin_row_meta_filter($links, $file) {
		if ($file == WPKRPANO_PLUGIN_BASENAME) {
			// append link to the krpano homepage
			$links[] = '<a href="http://www.krpano.com/" title="' . esc_attr__('krpano Flash Panorama Viewer', WPKRPANO_I18N_DOMAIN) . '">' . esc_html__('krpano', WPKRPANO_I18N_DOMAIN) . '</a>';
			// append link to donation to plugin author using PayPal
//			$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FQV5WXMTR6NE8">' . esc_html__('Donate', WPKRPANO_I18N_DOMAIN) . '</a>';
		}
		return $links;
	}
	add_filter('plugin_row_meta', 'wpkrpano_plugin_row_meta_filter', 10, 2);

	/**
	 * WP Action: admin_menu
	 */
	function wpkrpano_admin_menu() {
		add_options_page(__('WP krpano Settings', WPKRPANO_I18N_DOMAIN), __('WP krpano', WPKRPANO_I18N_DOMAIN), 'manage_options', WPKRPANO_SETTINGS_PAGE, 'wpkrpano_do_settings_page');
	}
	add_action('admin_menu', 'wpkrpano_admin_menu' );

	/**
	 * WP Action: admin_init
	 */
	function wpkrpano_admin_init() {
		register_setting(WPKRPANO_SETTINGS_GROUP, WPKRPANO_OPTIONS, 'wpkrpano_validate_settings');
	}
	add_action('admin_init', 'wpkrpano_admin_init');

	/**
	 * Plugin Settings Filter
	 *
	 * @param $settings The array of plugin settings to validate.
	 * @return The filtered plugin settings.
	 */
	function wpkrpano_validate_settings($settings) {
		$filteredsettings['default-krpano-url'] = trim($settings['default-krpano-url']);
		$filteredsettings['default-width'] = trim($settings['default-width']);
		$filteredsettings['default-height'] = trim($settings['default-height']);

		return $filteredsettings;
	}

	/**
	 * Plugin Settings Page
	 */
	function wpkrpano_do_settings_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e('WP krpano Settings', WPKRPANO_I18N_DOMAIN) ?></h2>
			<h3><?php esc_html_e('Defaults', WPKRPANO_I18N_DOMAIN) ?></h3>
			<p><?php esc_html_e('Specify the default values for various WP krpano shortcode attibutes. These default values can be overridden by specifiying the appropriate attribute(s) to the WP krpano shortcode when needed.', WPKRPANO_I18N_DOMAIN) ?></p>
			<form method="post" action="options.php">
				<?php settings_fields(WPKRPANO_SETTINGS_GROUP) ?>
				<?php $options = get_option(WPKRPANO_OPTIONS); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="default-krpano-url"><?php esc_html_e('krpano URL', WPKRPANO_I18N_DOMAIN)?></label></th>
						<td>
							<input id="default-krpano-url" name="<?php echo(WPKRPANO_OPTIONS) ?>[default-krpano-url]" type="text" class="regular-text code" value="<?php echo(esc_attr($options['default-krpano-url'])) ?>" />
							<span class='description'><?php esc_html_e('The absolute or relative URL to the krpano SWF.', WPKRPANO_I18N_DOMAIN) ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="default-width"><?php esc_html_e('Width', WPKRPANO_I18N_DOMAIN)?></label></th>
						<td>
							<input id="default-width" name="<?php echo(WPKRPANO_OPTIONS) ?>[default-width]" type="text" class="small-text" value="<?php echo(esc_attr($options['default-width'])) ?>" />
							<span class='description'><?php esc_html_e('The default witdh of the embedded krpano object.', WPKRPANO_I18N_DOMAIN) ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="default-height"><?php esc_html_e('Height', WPKRPANO_I18N_DOMAIN)?></label></th>
						<td>
							<input id="default-height" name="<?php echo(WPKRPANO_OPTIONS) ?>[default-height]" type="text" class="small-text" value="<?php echo(esc_attr($options['default-height'])) ?>" />
							<span class='description'><?php esc_html_e('The default height of the embedded krpano object.', WPKRPANO_I18N_DOMAIN) ?></span>
						</td>
					</tr>
				</table>
				<?php do_settings_sections(WPKRPANO_SETTINGS_PAGE) ?>
				<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" /></p>
			</form>
		</div>
		<?php
	}

	/**
	 * Plugin Activation Hook
	 */
	function wpkrpano_activate() {
		# set the plugin's settings defaults
		add_option(WPKRPANO_OPTIONS, array(
			'default-krpano-url' => 'krpano.swf',
			'default-width' => 320,
			'default-height' => 240
		));
	}
	register_activation_hook(__FILE__, 'wpkrpano_activate');

	/**
	 * Plugin Deactivation Hook
	 */
	function wpkrpano_deactivate() {
	}
//	register_deactivation_hook(__FILE__, 'wpkrpano_deactivate');

	/**
	 * Plugin Uninstallation Hook
	 */
	function wpkrpano_uninstall() {
		delete_option(WPKRPANO_OPTIONS);
	}
	register_uninstall_hook(__FILE__, 'wpkrpano_uninstall');
}

/**
 * Plugin Shortcode Handler
 *
 * @param $attributes The array of specified attributes (key=value pairs).
 * @param $content The specified content (optional).
 * @return The generated HTML for the shortcode.
 */
function wpkrpano_shortcode_handler($attributes, $content='') {
	$options = get_option(WPKRPANO_OPTIONS);
	extract(shortcode_atts(array(
		'krpano' => $options['default-krpano-url'],
		'xml' => '',
		'title' => '',
		'width' => $options['default-width'],
		'height' => $options['default-height'],
		'debug' => FALSE
	), $attributes));

	return '
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
	codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0"
	width="'.$width.'" height="'.$height.'" title="'.$title.'">
	<param name="allowFullScreen" value="true" />
	<param name="movie" value="' . $krpano . '" />
	<param name="flashvars" value="pano=' . $xml . '">
	<param name="quality" value="high" />
	<param name="bgcolor" value="#FFFFFF" />
	<embed src="'.$krpano .'"
		allowFullScreen="true"
		width="'.$width.'" height="'.$height.'" quality="high"
		flashvars="pano='.$xml.'"
		pluginspage="http://www.macromedia.com/go/getflashplayer"
		type="application/x-shockwave-flash" bgcolor="#FFFFFF">
	</embed>
</object>
';
}
add_shortcode(WPKRPANO_SHORTCODE, 'wpkrpano_shortcode_handler');

?>