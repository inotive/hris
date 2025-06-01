@props([
    'label' => null,
    'lat' => '',
    'lng' => '',

    'lat_input' => 'lat',
    'lng_input' => 'lng',

    'prefix' => 'map' . uniqid(),
])

@php
if ($lat == 0) {
    $lat = -6.175605558491494;
    $lng = 106.82693230874003;
}
@endphp
<div>


    <x-form.hidden type="text" label="Latitude" name="{{ $lat_input }}" :value="$lat ?? ''" />
    <x-form.hidden type="text" label="Longitude" name="{{ $lng_input }}" :value="$lng ?? ''" />

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $prefix }}_mapModal">
        {{ $label ?? __('Pick Location') }}
    </button>

    <div id="{{ $prefix }}_mapview" class="mt-2 rounded" style="height: 200px;width:100%"></div>

    <!-- Modal -->
    <div class="modal fade" id="{{ $prefix }}_mapModal" aria-hidden="false" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title -ml-1">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </h5>
                    <button id="{{ $prefix }}_saveLocation" type="button" class="btn btn-primary">{{ __('Save') }}</button>

                </div>
                <div class="modal-body p-0" style="height: 550px;">

                    <input type="text" autocomplete="off" id="{{ $prefix }}_searchBox" class="form-control border-0"
                        placeholder="Search address...">
                    <div id="{{ $prefix }}_map" style="height: 450px;"></div>

                    <div id="{{ $prefix }}_selectedAddress" class="p-2 text-muted"></div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .leaflet-control-attribution {
            display: none;
        }
    </style>
    <script>
        let {{ $prefix }}_map;
        let {{ $prefix }}_marker;
        let {{ $prefix }}_mapView;
        let {{ $prefix }}_markerView;

        var {{ $prefix }}_defaultLat = -6.200000;
        var {{ $prefix }}_defaultLng = 106.816666;

        

        $(document).ready(function() {
            // Initialize mapView outside modal (read-only map)
            var lat = $("#{{ $lat_input }}").val() || {{ $prefix }}_defaultLat;
            var lng = $("#{{ $lng_input }}").val() || {{ $prefix }}_defaultLng;

            console.log({{ $lat }});
            console.log({{ $lng }});


            {{ $prefix }}_setMapView(lat, lng);
            
        });

        function {{ $prefix }}_setMapView(lat, lng) {
            if (!{{ $prefix }}_mapView) {
                {{ $prefix }}_mapView = L.map('{{ $prefix }}_mapview').setView([lat, lng], 16); // Default to Jakarta
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '',
                    maxZoom: 19
                }).addTo({{ $prefix }}_mapView);
                {{ $prefix }}_setMarkerView(lat, lng);

                console.log("init set map view");
            } else {
                console.log("Init map");

                {{ $prefix }}_mapView.invalidateSize();
            }

        }

        async function getCurrentLocation() {
            if (!navigator.geolocation) {
                console.log('Geolocation is not supported by this browser.');
                return { lat: null, lng: null };
            }

            try {
                const position = await new Promise((resolve, reject) =>
                navigator.geolocation.getCurrentPosition(resolve, reject)
                );

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                console.log('Latitude:', lat);
                console.log('Longitude:', lng);
                return { lat, lng };
            } catch (error) {
                console.error('Error getting location:', error.message);
                return { lat: null, lng: null };
            }
        }

        // Handle modal map initialization
        document.getElementById('{{ $prefix }}_mapModal').addEventListener('shown.bs.modal', function  ()  {
            console.log("open modal");
            setTimeout(async () => {
                var lat = $("#{{ $lat_input }}").val() || {{ $prefix }}_defaultLat;
                var lng = $("#{{ $lng_input }}").val() || {{ $prefix }}_defaultLng;

                if (lat == 0 && navigator.geolocation) {
                    var reslat = await getCurrentLocation();

                    if (reslat != null) {
                        lat = reslat.lat;
                        lng = reslat.lng;
                        
                    }
                } else {
                console.log('Geolocation is not supported by this browser.');
                }

                if (!{{ $prefix }}_map) {
                    {{ $prefix }}_map = L.map('{{ $prefix }}_map').setView([lat, lng], 19); // Default to Jakarta
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                        attribution: '',
                        maxZoom: 19
                    }).addTo({{ $prefix }}_map);

                    {{ $prefix }}_setMarker(lat, lng);
                    {{ $prefix }}_fetchAddress(lat, lng);

                    {{ $prefix }}_map.on('click', function(e) {
                        const {
                            lat,
                            lng
                        } = e.latlng;
                        {{ $prefix }}_setMarker(lat, lng);
                        {{ $prefix }}_fetchAddress(lat, lng);
                    });

                    console.log("Map initialized inside modal");
                } else {
                    console.log("map init");
                    {{ $prefix }}_map.invalidateSize(); // Trigger resize if map already exists
                }
            }, 500);
        });
     
        // Set marker for both view and modal maps
        function {{ $prefix }}_setMarker(lat, lng) {
            // For modal map
            if ({{ $prefix }}_marker) {
                {{ $prefix }}_marker.setLatLng([lat, lng]);
            } else {
                {{ $prefix }}_marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo({{ $prefix }}_map);

                {{ $prefix }}_marker.on('dragend', function(e) {
                    const pos = e.target.getLatLng();
                    {{ $prefix }}_fetchAddress(pos.lat, pos.lng);
                });
            }

        }

        function {{ $prefix }}_setMarkerView(lat, lng) {

            // For view map (read-only marker)
            if ({{ $prefix }}_markerView) {
                {{ $prefix }}_markerView.setLatLng([lat, lng]);
            } else {
                {{ $prefix }}_markerView = L.marker([lat, lng], {
                    draggable: false
                }).addTo({{ $prefix }}_mapView);
            }
        }

        // Fetch address from coordinates using OpenStreetMap API
        function {{ $prefix }}_fetchAddress(lat, lon) {
            $.get('https://nominatim.openstreetmap.org/reverse', {
                lat: lat,
                lon: lon,
                format: 'json'
            }, function(data) {
                const address = data.display_name || 'Address not found';
                {{ $prefix }}_showAddress(lat, lon, address);
            });
        }

        // Show the selected address
        function {{ $prefix }}_showAddress(lat, lon, address) {
            $('#{{ $prefix }}_selectedAddress').html(`<strong>Selected Address:</strong><br>${address}`);
        }

        // Handle save location
        $('#{{ $prefix }}_saveLocation').on('click', function() {
            if ({{ $prefix }}_marker) {
                const latlng = {{ $prefix }}_marker.getLatLng();

                // Set the values of the hidden lat/lng fields
                $('#{{ $lat_input }}').val(latlng.lat);
                $('#{{ $lng_input }}').val(latlng.lng);


                $("#{{ $prefix }}_mapModal").modal('hide');
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');

                {{ $prefix }}_mapView.setView([latlng.lat, latlng.lng], 16);
                {{ $prefix }}_setMarkerView(latlng.lat, latlng.lng);
            }
        });

        // Autocomplete for searching addresses
        $('#{{ $prefix }}_searchBox').autocomplete({
            appendTo: "body",
            source: function(request, response) {
                $.get('https://nominatim.openstreetmap.org/search', {
                    q: request.term,
                    format: 'json',
                    addressdetails: 1,
                    limit: 5
                }, function(data) {
                    response(data.map(item => ({
                        label: item.display_name,
                        value: item.display_name,
                        lat: item.lat,
                        lon: item.lon
                    })));
                });
            },
            select: function(event, ui) {
                const lat = ui.item.lat;
                const lon = ui.item.lon;
                {{ $prefix }}_map.setView([lat, lon], 16);
                {{ $prefix }}_setMarker(lat, lon);
                {{ $prefix }}_showAddress(lat, lon, ui.item.label);
            },
            minLength: 3,
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            }
        });
    </script>
</div>
