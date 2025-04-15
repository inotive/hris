<style>
.leaflet-control-attribution {
  display:none;
}
</style>
<script>
  let map;
let marker;
let mapView;
let markerView;

var defaultLat = -6.200000;
var defaultLng = 106.816666;

$(document).ready(function() {
  // Initialize mapView outside modal (read-only map)
  var lat = $("#lat").val() || defaultLat;
  var lng = $("#lng").val() || defaultLng;


  setMapView(lat,lng);
});

function setMapView(lat, lng){
  if (!mapView) {
    mapView = L.map('mapview').setView([lat, lng], 16); // Default to Jakarta
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      attribution: '',
      maxZoom: 19
    }).addTo(mapView);
    setMarkerView(lat,lng);
  } else {
    mapView.invalidateSize();
  }
    
}

// Handle modal map initialization
$('#mapModal').on('shown.bs.modal', function () {
  setTimeout(() => {
    var lat = $("#lat").val() || defaultLat;
    var lng = $("#lng").val() || defaultLng;

    if (!map) {
      map = L.map('map').setView([lat, lng], 19); // Default to Jakarta
      L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '',
        maxZoom: 19
      }).addTo(map);

      setMarker(lat, lng);
      fetchAddress(lat, lng);

      map.on('click', function (e) {
        const { lat, lng } = e.latlng;
        setMarker(lat, lng);
        fetchAddress(lat, lng);
      });

      console.log("Map initialized inside modal");
    } else {
      map.invalidateSize(); // Trigger resize if map already exists
    }
  }, 200);
});

// Set marker for both view and modal maps
function setMarker(lat, lng) {
  // For modal map
  if (marker) {
    marker.setLatLng([lat, lng]);
  } else {
    marker = L.marker([lat, lng], { draggable: true }).addTo(map);

    marker.on('dragend', function (e) {
      const pos = e.target.getLatLng();
      fetchAddress(pos.lat, pos.lng);
    });
  }

}

function setMarkerView(lat, lng) {

  // For view map (read-only marker)
  if (markerView) {
    markerView.setLatLng([lat, lng]);
  } else {
    markerView = L.marker([lat, lng], { draggable: false }).addTo(mapView);
  }
}

// Fetch address from coordinates using OpenStreetMap API
function fetchAddress(lat, lon) {
  $.get('https://nominatim.openstreetmap.org/reverse', {
    lat: lat,
    lon: lon,
    format: 'json'
  }, function (data) {
    const address = data.display_name || 'Address not found';
    showAddress(lat, lon, address);
  });
}

// Show the selected address
function showAddress(lat, lon, address) {
  $('#selectedAddress').html(`<strong>Selected Address:</strong><br>${address}`);
}

// Handle save location
$('#saveLocation').on('click', function () {
  if (marker) {
    const latlng = marker.getLatLng();

    // Set the values of the hidden lat/lng fields
    $('#lat').val(latlng.lat);
    $('#lng').val(latlng.lng);


    $("#mapModal").modal('hide');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');

    mapView.setView([latlng.lat, latlng.lng], 16);
    setMarkerView(latlng.lat, latlng.lng);
  }
});

// Autocomplete for searching addresses
$('#searchBox').autocomplete({
  appendTo: "body",
  source: function (request, response) {
    $.get('https://nominatim.openstreetmap.org/search', {
      q: request.term,
      format: 'json',
      addressdetails: 1,
      limit: 5
    }, function (data) {
      response(data.map(item => ({
        label: item.display_name,
        value: item.display_name,
        lat: item.lat,
        lon: item.lon
      })));
    });
  },
  select: function (event, ui) {
    const lat = ui.item.lat;
    const lon = ui.item.lon;
    map.setView([lat, lon], 16);
    setMarker(lat, lon);
    showAddress(lat, lon, ui.item.label);
  },
  minLength: 3,
  position: {
    my: "left top",
    at: "left bottom",
    collision: "none"
  }
});



</script>