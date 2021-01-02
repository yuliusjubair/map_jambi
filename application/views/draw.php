<style type="text/css">
	#map2 { margin: 0; height: 100%; width: 100%; }
</style>
<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.css" rel="stylesheet" />

 <div class="mapcanvas" id="map2" style="height: 650px"></div>

<script type="text/javascript">
	// center of the map
var center = [46.165164, 15.750443];

// Create the map
var map = L.map('map2').setView(center,15);

// Set up the OSM layer
L.tileLayer(
  'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
    maxZoom: 18
  }).addTo(map);



// Initialise the FeatureGroup to store editable layers
var editableLayers = new L.FeatureGroup();
map.addLayer(editableLayers);

var options = {
  position: 'topleft',
  draw: {
    polygon: {
      allowIntersection: false, // Restricts shapes to simple polygons
      drawError: {
        color: '#e1e100', // Color the shape will turn when intersects
        message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
      },
      shapeOptions: {
        color: '#97009c'
      }
    },
    polyline: {
    	shapeOptions: {
        color: '#f357a1',
        weight: 10
          }
    },
    // disable toolbar item by setting it to false
    polyline: true,
    circle: true, // Turns off this drawing tool
    polygon: true,
    marker: true,
    rectangle: true,
  },
  edit: {
    featureGroup: editableLayers, //REQUIRED!!
    remove: true
  }
};

// Initialise the draw control and pass it the FeatureGroup of editable layers
var drawControl = new L.Control.Draw(options);
map.addControl(drawControl);

var editableLayers = new L.FeatureGroup();
map.addLayer(editableLayers);

map.on('draw:created', function(e) {
  var type = e.layerType,
    layer = e.layer;
editableLayers.addLayer(layer);
  if (type === 'polyline') {
  	// console.log();
     layer.bindPopup('A polyline!'+layer._latlngs[0].lat);
    //layer.bindPopup('LatLng: ' + layer.getLatLng()).openPopup();
  } else if ( type === 'polygon') {
  	layer.bindPopup('A polygon!');
  } else if (type === 'marker') 
  {layer.bindPopup('marker!');}
  else if (type === 'circle') 
  {layer.bindPopup('A circle!');}
   else if (type === 'rectangle') 
  {layer.bindPopup('A rectangle!');}


  
});
</script>