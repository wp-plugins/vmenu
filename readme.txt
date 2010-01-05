=== VMenu ===
Contributors: charlener
Tags: menu, vertical, categories, widget
Requires at least: 2.9
Tested up to: 2.9
Stable tag: 0.1

Makes a vertical javascript-based menu (currently at two levels max) from your categories on your site. 

== Description ==
A widget. With no options. See the FAQ concerning current limitations. Pretty much entirely ported code from http://www.leigeber.com/2008/05/vertical-flyout-javascript-menu/, where it's under CC licensing. 

== Installation ==

1. Upload `vmenu.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Drag "VMenu" into your active widgets.

== Frequently Asked Questions ==

= What's the gotchas? =

It only works at two levels max. And if you have categories with no posts (empty categories) that are subcategories, it makes the menu not display correctly. And it only works properly, really, on left sidebars. And it sorts categories by alpha only right now. And to change any options at the moment you have to go into code. 

= It doesn't show menus! =

It adds in links to CSS and JS stuff but it's based on a default install with path to wp-content/plugins/vmenu. Please don't change that.


== Screenshots ==

1. Menu rolling over level-1 category.
2. Menu rolling over level-2 category. CSS based on link styling from the theme.

== Changelog ==

= 0.1 =
* Initial version