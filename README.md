zp_mapembed
===========

A Zenphoto plugin to embed maps from Google Maps or OpenStreetMap via content macros.

**Requires Zenphoto 1.4.5!**

Install
-------
Place the plugin file within `/plugin` and enable the plugin.
 
Usage
------
Google Maps example:

`[GOOGLEMAP http://maps.google.de/maps?hl=de&ll=45.706179,4.921875&spn=49.865069,79.189453&t=m&z=4 100% 300 googlemap]`

The url is the map link followed by width/height (number or percentage like 100%) and a CSS class name (all required)

OpenStreetMaps examples:

1. `[OPENSTREETMAP http://www.openstreetmap.org/?lat=47.1&lon=22.7&zoom=4&layers=M 100% 300 openstreetmap]`
2. `[OPENSTREETMAP http://www.openstreetmap.org/export/embed.html?bbox=-11,14.5,56.4,67.4&amp;layer=mapnik 100% 300 openstreetmap]` 

The url can be: 

1. The permalink you find at the bottom of the map page.
2. The permalink url or the url you sadly need to extract from the iFrame export code (Sadly they do not list that plain url)

Those followed as above by width/height (number or percentage like 100%) and a CSS class name (all required)
