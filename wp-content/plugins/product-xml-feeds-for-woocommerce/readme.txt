=== Product XML Feeds for WooCommerce ===
Contributors: algoritmika,anbinder
Tags: woocommerce,product xml feeds
Requires at least: 4.4
Tested up to: 4.8
Stable tag: 1.2.1
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Product XML feeds for WooCommerce.

== Description ==

Plugin lets you add WooCommerce product XML feeds.

Feeds can be customized by:

* XML Header
* XML Item
* XML Footer
* XML File Path and Name
* Update Period
* Variable Products
* Products to Include/Exclude
* Categories to Include/Exclude
* Tags to Include/Exclude
* Products Scope

= Feedback =
* We are open to your suggestions and feedback. Thank you for using or trying out one of our plugins!

== Installation ==

1. Upload the entire 'product-xml-feeds-for-woocommerce' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Start by visiting plugin settings at WooCommerce > Settings > Product XML Feeds.

== Changelog ==

= 1.2.1 - 31/07/2017 =
* Dev - `on_empty` attribute added to all shortcodes.

= 1.2.0 - 27/07/2017 =
* Dev - WooCommerce v3 compatibility - Getting product ID and short description with functions (instead of accessing properties directly).
* Dev - WooCommerce v3 compatibility - `get_price_including_tax()` and `get_price_excluding_tax()` replaced with `wc_get_price_including_tax()` and `wc_get_price_excluding_tax()`.
* Dev - WooCommerce v3 compatibility - `get_tags()` and `get_categories()` replaced with `wc_get_product_tag_list()` and `wc_get_product_category_list()`.
* Dev - WooCommerce v3 compatibility - `list_attributes()` replaced with `wc_display_product_attributes()`.
* Dev - WooCommerce v3 compatibility - `$_product->get_dimensions( true )` replaced with `wc_format_dimensions( $_product->get_dimensions( false ) )`.
* Fix - `[alg_product_available_variations]` - "Glued" attributes bug fixed etc.
* Dev - `[alg_product_id]` shortcode added.
* Dev - `[alg_product_time_since_last_sale]` - Code refactoring.
* Dev - Link updated from http://coder.fm to https://wpcodefactory.com.
* Dev - Plugin header ("Text Domain" etc.) updated.
* Dev - Code cleanup and minor fixes.
* Dev - POT file added.

= 1.1.1 - 15/01/2017 =
* Fix - "If plugin is enabled" check fixed.

= 1.1.0 - 12/01/2017 =
* Fix - "Variable Products" option description and attributes fixed.
* Dev - Settings for each feed moved to separate section.
* Dev - `[alg_current_datetime]` shortcode added.
* Dev - Link to all available shortcodes added.

= 1.0.0 - 10/01/2017 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
