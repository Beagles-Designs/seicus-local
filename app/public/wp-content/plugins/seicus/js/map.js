
(function($) {

/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/


 
function render_map( $el ) {
 
	// var
	var $markers = $el.find('.marker');
 
	// vars
	var args = {
		zoom		: 4,
		center		: new google.maps.LatLng(37.09024, -95.712891),
		mapTypeId	: google.maps.MapTypeId.TERRAIN
	};
 
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
 
	// add a markers reference
	map.markers = [];
 
	// add markers
	$markers.each(function(){
 
    	add_marker( $(this), map );
 
	});

	//add kml files
	var kmlarray = [];
	$('.kml-files .kml-file').each(function() {
		kmlarray.push($(this).text());
	});
	
 	var kmlLayer;

 	$.each(kmlarray,function(i,val) {
	 	kmlLayer = new google.maps.KmlLayer({
	 		url: val,
	 		preserveViewport: true,
	 	});
	 	kmlLayer.setMap(map);
	 	// add to layer array
	});
	 	//end foreach

 	 

	// center map
	center_map( map );
 
}
 
/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/
 


function add_marker( $marker, map ) {
 	
	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
 	var iconBase = '/wp-content/themes/blue-trails/library/images/map-icons/';
 	var title = $marker.attr('data-title');
 	var type = $marker.attr('data-type');
 	var iconpath;
 	//icon switch statement
 	switch(type){
 		case 'access-point':
 			iconpath = iconBase + 'access_point.png';
 			break;
 		case 'area-of-concern' :
 			iconpath = iconBase + 'area_of_concern.png';
 			break;
 		case 'campsite':
 			iconpath = iconBase + 'campsite.png';
 			break;
 		case ' confluence':
 			iconpath = iconBase + 'confluence.png';
 			break;
 		case 'historical-landmark' :
 			iconpath = iconBase + 'historical_landmark.png';
 			break;
 		case 'important-bird-area':
 			iconpath = iconBase + 'impt_bird_area.png';
 			break;
 		case 'lake' :
 			iconpath = iconBase + 'lake.png';
 			break;
 		case 'local-businesses':
 			iconpath = iconBase + 'local_business.png';
 			break;
 		case 'monument':
 			iconpath = iconBase + 'monument.png';
 			break;
 		case 'parks':
 			iconpath = iconBase + 'park.png';
 			break;
 		case 'parking':
 			iconpath = iconBase + 'parking.png';
 			break;
 		case 'point-of-interest':
 			iconpath = iconBase + 'Point_of_Interest.png';
 			break;
 		case 'private-property':
 			iconpath = iconBase + 'private_property.png';
 			break;
 		case 'protected':
 			iconpath = iconBase + 'protected_spring';
 			break;
 		case 'take-a-load-off':
 			iconpath = iconBase + 'take-a-load-off.png';
 			break;
 		case 'toilets':
 			iconpath = iconBase + 'toilets.png';
 			break;
 		case 'trails': 
 			iconpath = iconBase + 'trails.png';
 			break;
 		default:
 			iconpath = iconBase + 'Point_of_Interest.png';
 	}
	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
		icon: iconpath,
		title: title,
	});
 
	// add to array
	map.markers.push( marker );
 	var currentInfoWindow = null;
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{	
		
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
 
		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {
			if (currentInfoWindow != null) { 
			     currentInfoWindow.close(); 
			 } 
			infowindow.open( map, marker );	
			currentInfoWindow = infowindow; 
		});
	}
 
}
 
/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/
 
function center_map( map ) {
 
	// vars
	var bounds = new google.maps.LatLngBounds();
 
	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){
 
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
 
		bounds.extend( latlng );
 
	});
 
	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 13 );
	}
	//no markers
	else if(map.markers.length == 0) {
		map.setCenter('37.09024, -95.712891');
		map.setZoom( 13 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}
 
}
 
/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
 
$(document).ready(function(){
 
	$('.river-map').each(function(){
 
		render_map( $(this) );
 
	});
 
});
 
})(jQuery);