<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-firestore.js"></script>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 25%;
        padding: 5px;
        position: absolute;
        top: 10px;
        z-index: 5;
      }
    </style>
  </head>

  <body>
  <pre id="location">
  </pre>
    <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
    </div>
	<div id="container">
    <div id="map"></div>
	</div>
	


  <script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyC3ti-4Ha53a52-G5hOOdyjWLkZzCFSqME",
    authDomain: "quik-response.firebaseapp.com",
    databaseURL: "https://quik-response.firebaseio.com",
    projectId: "quik-response",
    storageBucket: "quik-response.appspot.com",
    messagingSenderId: "3922924606",
    appId: "1:3922924606:web:6baedfd6f193bec2e2ed6f",
    measurementId: "G-SSD5K11KXD"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>

    <script>
     var map, heatmap,htmap,marker;
	 function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 23.412309,lng:85.439791},
          mapTypeId: 'satellite'
        });
		
   heatmap = new google.maps.visualization.HeatmapLayer({
  data:[],
  map:map
});
	 }
	   
  const preobject= document.getElementById('DATA');
  const db=firebase.firestore();
  db.collection("DATA").onSnapshot(function (querySnapshot){
	  querySnapshot.docChanges().forEach(function (change)
	  {
		  if(change.type==="added")
		  {
			  var lati=change.doc.data().LAT;
		     var longi=change.doc.data().LON;
		     locate={lat:lati,lng:longi};
			 console.log(locate);
		     htmap=new google.maps.LatLng(lati,longi);
			   heatmap.getData().push(htmap); 
	         
		  }	
          if (change.type === "modified") {
               
			  var lati=change.doc.data().LAT;
		     var longi=change.doc.data().LON;
		     htmap=new google.maps.LatLng(lati,longi);
			   heatmap.getData().push(htmap); 
	        
            }
            if (change.type === "removed") {
               
			  var lati=change.doc.data().LAT;
		     var longi=change.doc.data().LON;
		     locate={lat:lati,lng:longi};
		     htmap=new google.maps.LatLng(lati,longi);
			   heatmap.getData().push(htmap); 
            }	
	  });
  });  
      function toggleHeatmap() {
       heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }

      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }   
	  
	
    </script>
	<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=&libraries=visualization&callback=initMap">
    </script>
    
	
  </body>
