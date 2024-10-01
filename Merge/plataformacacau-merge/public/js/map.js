function initMap() {
    // DOM envs
    var map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 15,
        mapTypeId: "satellite",
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false
        // styles: black_theme
    });
    var infoWindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder();
    var heatmap_data = [];
    var input = document.getElementById("search-box");
    var search_box = new google.maps.places.SearchBox(input);
    var data_coordinates;
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                var pos = new google.maps.LatLng(
                    // position.coords.latitude,
                    // position.coords.longitude
                    -14.785515,
                    -39.223076
                );
                console.log(pos);

                // DEBUG      =============
                geocoder.geocode({ latLng: pos }, function(results, status) {
                    json_address_info = results[0].address_components;
                });
                // END DEBUG  =============

                infoWindow.setPosition(pos);
                var marker = new google.maps.Marker({
                    position: pos,
                    map: map
                });
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        handleLocationError(false, infoWindow, map.getCenter());
    }

    var markers = [],
        info_windows = [];
    for (let i = 0; i < 10; i++) {
        markers[i] = new google.maps.Marker({
            position: new google.maps.LatLng(
                -14.7840192 - Math.random() * (0.1 - 0.05) + 0.05,
                -39.27150519999998 + Math.random() * (0.1 - 0.05) + 0.05
            ),
            map: map,
            icon: {
                url: "../img/cocoa.svg",
                scaledSize: new google.maps.Size(23, 23),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0)
            }
            // label: atributo_tabela
        });
        console.log(i);
        info_windows[i] = new google.maps.InfoWindow({
            content:
                '<div class="d-flex">\
                <div class="title mx-auto">Titulo</div>\
                <hr />\
                <div class="">\
                </div>\
            </div>'
        });

        markers[i].addListener("click", function() {
            info_windows[i].open(map, markers[i]);
        });
    }

    // heatmap
    // var heatmap = new google.maps.visualization.HeatmapLayer({
    //   data: wind_points
    // });
    // heatmap.setMap(map);

    // listeners
    map.addListener("click", function() {});
    map.addListener("bounds_changed", function() {
        search_box.setBounds(map.getBounds());
    });
    google.maps.event.addListener(search_box, "places_changed", function() {
        search_box.set("map", null);
        var places = search_box.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; (place = places[i]); i++) {
            (function(place) {
                var marker = new google.maps.Marker({
                    position: place.geometry.location
                });
                marker.bindTo("map", search_box, "map");
                google.maps.event.addListener(
                    marker,
                    "map_changed",
                    function() {
                        if (!this.getMap()) {
                            this.unbindAll();
                        }
                    }
                );
                bounds.extend(place.geometry.location);
            })(place);
        }
        map.fitBounds(bounds);
        search_box.set("map", map);
        map.setZoom(Math.min(map.getZoom(), 12));
        google.maps.event.addListener(marker, "click", function() {
            if (infoWindow) {
                infoWindow.close();
            }
            infoWindow = new google.maps.InfoWindow({ content: "dasdasd" });
            infoWindow.open(map, marker);
        });
    });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

function addMarker(location, map) {
    var marker = new google.maps.Marker({
        position: location,
        label: labels[labelIndex++ % labels.length],
        map: map
    });
}
