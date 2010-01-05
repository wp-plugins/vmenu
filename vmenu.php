<?php
/*
Plugin Name: VMenu
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Vertical javascript-based menu that pulls from categories (max 2 levels).
Version: 0.1
Author: Charlene Barina
Author URI: http://www.ploofle.com

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function cmp( $a, $b )
	{ 
		if(  $a->parent ==  $b->parent ){ return 0 ; } 
		return ($a->parent < $b->parent) ? -1 : 1;
	}

function v_makemenu() {
	$result = get_categories('orderby=name&hide_empty=0&hierarchical=1');
	  
	  foreach ($result as $key=>$value) {
		if ($value->parent == 0) 
			$parentlist[] = $value;
		else $childlist[$key] = $value;
	  }
		usort($childlist,'cmp');

		foreach ($parentlist as $key=>$value) {
			if (get_categories('child_of='.$value->term_id.'')) {
				$tickmark = " &raquo;";
			}
			else $tickmark = "";
			$menu[$value->term_id] = "\n<dl class=\"dropdown\">\n\t<dt id=\"".$value->term_id."-ddheader\" class=\"upperdd\" onmouseover=\"ddMenu('".$value->term_id."',1)\" onmouseout=\"ddMenu('".$value->term_id."',-1)\"><a href=\"".get_bloginfo('url')."/category/".$value->slug."\">".$value->name."$tickmark</a></dt>\n";		
		}
		
		$currentval = 999;
		foreach ($childlist as $key=>$value) {
			if (($currentval == 999 && $currentval != $value->parent)) {
				$menu[$value->parent] .= "\t\t<dd id=\"".$value->parent."-ddcontent\" onmouseover=\"cancelHide('".$value->parent."')\" onmouseout=\"ddMenu('".$value->parent."',-1)\">\n<ul>";
				$currentval = $value->parent;
			}
			elseif ($currentval != $value->parent) {
				$menu[$currentval] .= "</ul></dd></dl>\n";
				$menu[$value->parent] .= "\t\t<dd id=\"".$value->parent."-ddcontent\" onmouseover=\"cancelHide('".$value->parent."')\" onmouseout=\"ddMenu('".$value->parent."',-1)\">\n<ul>";
				$currentval = $value->parent;
			}
			$menu[$value->parent] .= "\t\t\t<li><a href=\"".get_bloginfo('url')."/category/".$value->slug."\" class=\"underline\">".$value->name."</a></li>\n";
		}
		foreach ($menu as $key=>$value) echo $value;
}

function v_addscripts() {
?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('url') ?>/wp-content/plugins/vmenu/flyout.css" />
<script type="text/javascript" src="<?php bloginfo('url') ?>/wp-content/plugins/vmenu/flyout.js"></script>
<?php
}

function widget_v_makemenu() {
	v_makemenu();
}

function v_makemenu_init()
{
  register_sidebar_widget(__('VMenu'), 'widget_v_makemenu');    
}

add_action('wp_head','v_addscripts');
add_action('plugins_loaded','v_makemenu_init');
?>