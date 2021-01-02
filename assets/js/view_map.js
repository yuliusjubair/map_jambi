 var mymap = L.map('map2', { zoomControl: false , attributionControl: false}).setView([-1.5901393059041389, 103.613788273547], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

       /* L.marker([-1.5901393059041389, 103.613788273547]).bindPopup('Pantai Widuri').addTo(mymap);
        L.marker([-1.5908134888912264, 103.6148564626511]).bindPopup('Nilla Collection').addTo(mymap);
        L.marker([-1.5910250526576806, 103.61329557823376]).bindPopup('Alun-Alun Jambi').addTo(mymap);
        L.marker([-1.589755669733535, 103.61414215961264]).bindPopup('Hotel Aston Jambi').addTo(mymap);*/

          var route1 = L.Routing.control({
           // createMarker: function() { return null; },
            createMarker: function(i, wp) {
                return L.marker(wp.latLng).on('click', function(e) { 
                  open_video1();
                 }).bindPopup('Nama Jalan : JL. KH Wahid Hasyim, 26, Jambi <br /> Nomor : <br /> PIC :<br /> keterangan :');
            },
            waypoints: [
              L.latLng(-1.5901393059041389, 103.613788273547),
              L.latLng(-1.5908134888912264, 103.6148564626511)
            ]
          }).addTo(mymap);