var map = new ol.Map({
    target: 'map',
    layers: [new ol.layer.Tile({
        source: new ol.source.OSM()
    })],
    view: new ol.View({
        //projection: 'EPSG:4326',
        center: ol.proj.fromLonLat([114, 0]),
        zoom: 5
    })
});

map.on('pointermove', (e) => {
    var coor = ol.proj.toLonLat(e.coordinate);
    //console.log(coor);
    $('#coordinate').html(coor[0].toFixed(3) + " , " + coor[1].toFixed(3)); // e.coodinate.toString().replace(' ', ','));
});

map.on('click', function(e) {
    //alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
});