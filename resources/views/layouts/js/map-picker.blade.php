
<script>
  let map;
    let marker;
  
    $('#mapModal').on('shown.bs.modal', function () {
      setTimeout(() => {
        if (!map) {
          map = L.map('map').setView([-6.200000, 106.816666], 13); // Jakarta default
  
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
          }).addTo(map);
  
          map.on('click', function (e) {
            setMarker(e.latlng.lat, e.latlng.lng);
          });
        } else {
          map.invalidateSize();
        }
      }, 200);
    });
  
    function setMarker(lat, lng) {
      if (marker) {
        marker.setLatLng([lat, lng]);
      } else {
        marker = L.marker([lat, lng], { draggable: true }).addTo(map);
      }
    }
  
    $('#searchBox').on('keypress', function (e) {
      if (e.which === 13) {
       
            
        const query = $(this).val();
        $.get(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`, function (data) {
          if (data && data.length > 0) {
            const place = data[0];
            const lat = place.lat;
            const lon = place.lon;
            map.setView([lat, lon], 16);
            setMarker(lat, lon);
          }
        });

        e.preventDefault();
      }
    });
  
    $('#saveLocation').on('click', function () {
      if (marker) {
        const latlng = marker.getLatLng();
        alert(`Selected Location:\nLatitude: ${latlng.lat}\nLongitude: ${latlng.lng}`);
        $('#mapModal').modal('hide');
      }
    });


    $('#searchBox').autocomplete({
  appendTo: "body", // Always attach to body to avoid container clipping
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
  },
  minLength: 3,
  position: {
    my: "left top+5",     // position of dropdown relative to input
    at: "left bottom",    // anchor dropdown to bottom of input
    collision: "none"     // don't auto-flip above
  }
});


</script>