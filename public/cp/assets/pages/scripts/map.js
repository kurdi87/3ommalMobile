// When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 8,
            mapTypeId: 'roadmap',

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(25.901547, 43.284307), // New York

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: []
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');


        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(25.901547, 43.284307,15),
            map: map,

            title: 'كانف'
        }
        );
            var marker2 = new google.maps.Marker({
                    position: new google.maps.LatLng(25.901547, 43.384307,15),
                    map: map,

                    title: 'كانف'
                }
            );
            var marker3 = new google.maps.Marker({
                    position: new google.maps.LatLng(25.901547, 43.264307,15),
                    map: map,

                    title: 'كانف'
                }
            );



            var contentString = ' <div class="adv-box2 mapbox">' +
                '                        <div class="row">' +
                '                            <div class="col-xs-4 padding-left-right-5">' +
                '                                <div class="">' +
                '                                    <img src="img/adv/1.png" class=" " >' +
                '                                </div>' +
                '                            </div>' +
                '                            <div class="col-xs-8 padding-left-right-5">' +
                '                                <div class="row">' +
                '                                    <div class="col-md-12">' +
                '                                        <ul class="list-unstyled list-inline margin-bottom-0">' +
                '                                            <li class="active">.ايجار</li>' +
                '                                            <li>|</li>' +
                '                                            <li>أرض بالمنافع الاساسية </li>' +
                '                                            <li>|</li>' +
                '                                            <li>5000 م. م.</li>' +
                '                                        </ul>' +
                '' +
                '                                        <span class="location2">مبنى رقم 334 | المنطقة : القصيم</span>' +
                '                                    </div>' +
                '                                </div>' +
                '                                <div class="row content">' +
                '                                    <div class="col-xs-3 text-right ">' +
                '                                        <span class="price">27000</span>' +
                '                                    </div>' +
                '                                    <div class="col-xs-9 text-left ">' +
                '                                        <span class="price">ريال</span>' +
                '                                    </div>' +
                '                                </div>' +
                '                                <div class="row info">' +
                '                                    <div class="col-xs-2 padding-left-right-0 text-left">' +
                '                                        <i class="icon-Path-77"></i> <span>10</span>' +
                '                                        <span>غرف</span>' +
                '                                    </div>' +
                '                                    <div class="col-xs-3 padding-left-right-0 text-center">' +
                '                                        <i class="icon-fountain"></i> <span>1</span>' +
                '                                        <span>مسبح</span>' +
                '                                    </div>' +
                '                                    <div class="col-xs-3 padding-left-right-0 text-left">' +
                '                                        <i class=" icon-car"></i> <span>2</span>' +
                '                                        <span>غرف سيارة</span>' +
                '                                    </div>' +
                '                                    <div class="col-xs-4  text-right ">' +
                '                                        <div class="action-botton-more-info ">' +
                '                                            <a href="apartment.html"> مهتم بالعرض</a>' +
                '                                        </div>' +
                '                                    </div>' +
                '' +
                '' +
                '                                </div>' +
                '                            </div>' +
                '' +
                '' +
                '' +
                '                        </div>' +
                '                    </div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            marker.addListener('click', function() {
                map.setZoom(11);
                map.setCenter(marker.getPosition());

                infowindow.open(map, marker);
            });
            marker2.addListener('click', function() {
                map.setZoom(11);
                map.setCenter(marker2.getPosition());

                infowindow.open(map, marker2);
            });
            marker3.addListener('click', function() {
                map.setZoom(11);
                map.setCenter(marker3.getPosition());

                infowindow.open(map, marker3);
            });

            




        }