<?php
/**
 * A plugin to embed maps from Google Maps and OpenStreetMap using content macros.
 * 
 * Usage Googlemaps:
 * [GOOGLEMAP http://maps.google.de/maps?hl=de&ll=45.706179,4.921875&spn=49.865069,79.189453&t=m&z=4 100% 300 googlemap]
 * The url is the map link followed by width/height (number or percentage like 100%) and a CSS class name (all required)
 * 
 * OpenStreetMaps:
 * a) [OPENSTREETMAP http://www.openstreetmap.org/?lat=47.1&lon=22.7&zoom=4&layers=M 100% 300 openstreetmap]
 * b) [OPENSTREETMAP http://www.openstreetmap.org/export/embed.html?bbox=-11,14.5,56.4,67.4&amp;layer=mapnik 100% 300 googlemap] 
 *
 * The url can be: 
 * a) The permalink you find at the bottom of the map page.
 * b) The permalink url or the url you sadly need to extract from the iFrame export code (Sadly they do not list that plain url)
 *
 * Those followed as above by width/height (number or percentage like 100%) and a CSS class name (all required)
 *
 * @author Malte Müller (acrylian) <info@maltem.de>
 * @copyright 2014 Malte Müller
 * @license GPL v3 or later
 * @package plugins
 * @subpackage misc
 */
$plugin_is_filter = 9|THEME_PLUGIN|ADMIN_PLUGIN;
$plugin_description = gettext('A plugin to embed Google maps or OpenStreetMaps via content macro.');
$plugin_author = 'Malte Müller (acrylian)';
$plugin_version = '1.0.1';
$option_interface = 'zpmapembed';

zp_register_filter('content_macro','zpmapembed::macro');

class zpmapembed {
	var $width = '';
	var $height = '';
	/**
	 * class instantiation function
	 */
	function __construct() {
		setOptionDefault('zpmapembed_width',640);
		setOptionDefault('zpmapembed_height',480);
		$this->width = getOption('zpmapembed_width');
		$this->height = getOption('zpmapembed_height');
	}
	
	function getOptionsSupported() {
				$options = array(
							gettext('Default width of the embed') => array('key' => 'zpmapembed_width', 'type' => OPTION_TYPE_TEXTBOX,
										'order' => 0,
										'desc' => gettext('Number or percentage value (100 or 100%).')),
							gettext('Default height of the embed') => array('key' => 'zpmapembed_height', 'type' => OPTION_TYPE_TEXTBOX,
										'order' => 1,
										'desc' => gettext('Number or percentage value (100 or 100%).'))
			);
		return $options;
	}
	
	static function macro($macros) {
		$macros['GOOGLEMAP'] = array(
				'class'=>'function',
				'params'=> array('string','string*','string*','string*'), 
				'value'=>'zpmapembed::getGoogleMap',
				'owner'=>'zp_mapembed',
				'desc'=>gettext('Map url (%1); width (%2) and height (%3)– absolute number (e.g. 200) or percentage value (100%) allowed – and CSS class (%4).')
				);
		$macros['OPENSTREETMAP'] = array(
				'class'=>'function',
				'params'=> array('string','string*','string*','string*'), 
				'value'=>'zpmapembed::getOpenStreetMap',
				'owner'=>'zp_mapembed',
				'desc'=>gettext('Parameters: OSM Permalink url (%1); width (%2) and height (%3) – absolute number (e.g. 200) or percentage value (100%) allowed – and CSS class (%4).')
				);
		return $macros;
	}

	static function getGoogleMap($url,$width='100%',$height='200',$class='') {
		if(empty($width)) $width = $this->width;
		if(empty($height)) $height = $this->height;
		if(empty($class)) $class = 'zpgooglemap';
		return '<iframe class="'.$class.'" src="'.$url.'&amp;ie=UTF8&amp;output=embed" width="'.$width.'" height="'.$height.'"></iframe><p><a href="'.$url.'&amp;source=embed">'.gettext('Larger map display').'</a></p>';
	}
	
	static function getOpenStreetMap($url,$width='100%',$height='200',$class='') {
		if(empty($width)) $width = $this->width;
		if(empty($height)) $height = $this->height;
		if(empty($class)) $class = 'zpopenstreetmap';
		return '<iframe class="'.$class.'" src="'.$url.'" width="'.$width.'" height="'.$height.'"></iframe><p><a href="'.$url.'">'.gettext('Larger map display').'</a></p>';
	}
} // class end
?>