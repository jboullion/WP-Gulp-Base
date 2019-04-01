/**
 * Create a Google Map based on a properties object built with the 'pk_build_properties()' function
 * 
 * Used wherever there is a map on the site to instantiate the map
 * @param object properties JSON object of all properties to list on the map
 */
function buildMap(properties){
	// Styles a map in night mode.
	var bounds  = new google.maps.LatLngBounds();
	var map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 43.0731, lng: 89.4012}, 
		zoom: 9,
		fullscreenControl: false,
		disableDefaultUI: true,
		styles: [{"featureType":"landscape","elementType":"geometry.stroke","stylers":[{"color":"#22262b"},{"weight":1}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#fdffff"},{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#000000"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#fdffff"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"color":"#fdffff"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"color":"#fdffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"geometry.fill","stylers":[{"color":"#beebde"}]},{"featureType":"poi.attraction","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"color":"#bcd5b2"},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#d4f1c9"},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#77a0e6"},{"weight":1}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#335897"},{"weight":0.5}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#697479"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#ddf4ff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#77a0e6"},{"weight":0.5}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#133460"}]},{"featureType":"water","stylers":[{"color":"#81c6e4"}]}]
	});

	//https://developers.google.com/maps/documentation/javascript/custom-markers
	var infowindow = new google.maps.InfoWindow();


	// Create markers.
	properties.forEach(function(property) {
		
		var marker = new google.maps.Marker({
			position: { lat: parseFloat(property.position.lat), lng: parseFloat(property.position.lng) },
			icon: property.icon,
			map: map
		});

		loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
		bounds.extend(loc);

		google.maps.event.addListener(marker,'click', (function(marker,content){ 
			return function() {
				infowindow.setContent('<div id="info-window">'+content+'</div>');
				infowindow.open(map,marker);
			}; 
		})(marker,property.content)); 
	});
	

	//Fit map to markers
	map.fitBounds(bounds); 
	map.panToBounds(bounds); 
	
	// Don't zoom in too far, especially if there is only 1 property
	var listener = google.maps.event.addListener(map, "idle", function() { 
		if (map.getZoom() > 14) {
			map.setZoom(14); 
		}else{
			//zoom out just a little bit
			//map.setZoom(map.getZoom()-1)
		}
		google.maps.event.removeListener(listener); 
	});

	// close the info windows if the user clicks outside of the popup
	google.maps.event.addListener(map, "click", function(event) {
		infowindow.close();
	});

}