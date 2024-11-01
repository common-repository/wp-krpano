=== WP krpano ===
Contributors: No-Nonsense
Donate link: http://www.no-nonsense.de/
Tags: krpano, flash, panorama, images
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 1.2.1

WP krpano allows to easily embed and display panoramic images in posts using the Adobe Flash based interactive panorama viewer krpano.

== Description ==

WP krpano allows to easily embed and display panoramic images in posts using the Adobe Flash based interactive panorama viewer krpano.

**Note:** You need your own licensed version of [krpano](http://www.krpano.com/ "krpano Flash Panorama Viewer").

**Note:** This is an in-development release. Things may change rapidly.

To embed a panorama in a post simply use the following shortcode: `[krpano ...]`

You can specify the following attributes:

* `xml="<url>"` The URL to the XML file describing the panorama to display (mandatory).
* `krpano="<url>"` The URL to your `krpano.swf` (optional).
* `width=<width>` The width of the embedded krpano object (optional).
* `height=<height>` The height of the embedded krpano object (optional).

== Installation ==

You can download and install WP krpano using the built-in plugin installer, or you can download and install the plugin manually.

**Note:** You need your own licensed version of [krpano](http://www.krpano.com/ "krpano Flash Panorama Viewer").

1. In case of a manual installation, unzip the downloaded ZIP file and upload the `wp-krpano` directory to your `plugins` directory. Typically that's `wp-content/plugins/`.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== License ==

= WP krpano =
WP krpano is licensed under the [GNU General Public License](http://www.opensource.org/licenses/gpl-2.0.php) version 2 or later:

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

= SWF Object =
[SWF Object](http://code.google.com/p/swfobject/) is licensed under the [MIT License](http://www.opensource.org/licenses/mit-license.php):

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

== ToDo List ==

WP krpano is currently under heavy development. The following is an outlook at what is planned to be implemented next:

* Support of static/dynamic embedding of krpano using [SWFObject 2.2](http://code.google.com/p/swfobject/).
* Support for the krpano mousewheel fix (requires SWFObject).

== Frequently Asked Questions ==

ToDo

== Screenshots ==

ToDo

== Changelog ==

= 1.2.1 =
* Added removal of the plugin's settings/options during its uninstallation.

= 1.2.0 =
* Added a settings/options page/subpanel to the Wordpress settings administration panels to specify defaults for various `[krpano]` shortcode attributes.
* Added a link to the plugin's settings/options page/subpanel to the plugin's action link list (Activate, Deactivate, Delete, ...).

= 1.1.0 =
Initial release.

== Upgrade Notice ==

= 1.2.1 =
Added removal of the plugin's settings/options during its uninstallation.

= 1.2.0 =
Added a settings/options page/subpanel to the Wordpress settings administration panels.

= 1.1.0 =
Initial release.
