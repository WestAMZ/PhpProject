var map;

           function initMap()
           {
                var location ={lat: 11.492136, lng: -85.567300};
                map = new google.maps.Map(document.getElementById('map'),
                {
                    center: location,
                    zoom: 7
                });
               var marker = new google.maps.Marker
               ({
                    position: location,
                    map: map,
                    title: 'Arrastre a la ubiación a registrar!',
                    draggable: true
               });
               google.maps.event.addListener(marker, 'dragend',
                    function()
                    {
                        updatePosition(marker.getPosition());
                    });
           }
           function updatePosition(latLng)
           {
                jQuery('#latitude').val(latLng.lat());
                jQuery('#longitude').val(latLng.lng());
                jQuery('#location').val(latLng.lat()+" , "+latLng.lng());
           }
