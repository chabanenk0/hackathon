$(document).ready(function () {
    var Circles = [];

    function initialize() {
        var mapProp = {
            center: new google.maps.LatLng(50.42951794712287, 30.5859375),
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        google.maps.event.addListener(map, "click", function (event) {
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            if (Circles.length > 0) {
                for (var i = 0; i <= Circles.length - 1; i++) {
                    Circles[i].setMap(null);
                }
            }
            radius = new google.maps.Circle({map: map,
                radius: 100,
                center: event.latLng,
                fillColor: '#777',
                fillOpacity: 0.1,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                draggable: true,    // Dragable
                editable: true      // Resizable
            });
            Circles.push(radius);
            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(latitude, longitude);
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    document.getElementById('dinning_room_latitude').value = latitude;
                    document.getElementById('dinning_room_longitude').value = longitude;
                    document.getElementById('dinning_room_address').value = results[1].address_components[1]['short_name'];
                } else {
                    console.log("Geocoder failed due to: " + status);
                }
            });
            // Center of map
            map.panTo(new google.maps.LatLng(latitude, longitude));
        }); //end addListener
    }

    google.maps.event.addDomListener(window, 'load', initialize);

});