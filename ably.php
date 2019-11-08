<html>
<head>
<title>Publishing Emergency Response</title>
</head>
  <body>
    <h1>Publishing Emergency Response</h1>
    <p>As Soon as an emergency occurs this website will immediately push messages to the channels using ably realtime api.</p>
	<p>Nearby Ambulances,PCR Vans and Fire Bridages will be notified About the Situation.</p>
  </body>

  <!-- Include the latest Ably Library  -->
  <script src="https://cdn.ably.io/lib/ably.min-1.js"></script>

  <!-- Instance the Ably library  -->
  <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-firestore.js"></script>


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
  <script >
     var realtime = new Ably.Realtime("SSRsXA.SgO-gA:8st5DRQ52bcE_-OY");
	 var channel = realtime.channels.get("Accident");
    const preobject= document.getElementById('DATA');
  const db=firebase.firestore();
  db.collection("DATA").onSnapshot(function (querySnapshot){
	  querySnapshot.docChanges().forEach(function (change)
	  {
		  if(change.type==="added")
		  {
			 var lati=change.doc.data().LAT;
		     var longi=change.doc.data().LON;
			 var status=change.doc.data().STATUS;
			 var pos = status.lastIndexOf("Accident");
			 if(pos!=-1)
			 {	 
		        locate={lat:lati,lng:longi,sts:status};
			    console.log(locate);
		        channel.publish("update", { "lati": lati,"longi":longi });
			 }
			  
	         
		  }	
          if (change.type === "modified") {
               
			  var lati=change.doc.data().LAT;
		     var longi=change.doc.data().LON;
		     var status=change.doc.data().STATUS;
			 var pos = status.lastIndexOf("Accident");
			 if(pos!=-1)
			 {	 
		        locate={lat:lati,lng:longi,sts:status};
			    console.log(locate);
		        channel.publish("update", { "lati": lati,"longi":longi });
			 }
	        
            }
            if (change.type === "removed") {
               
			  var lati=change.doc.data().LAT;
		     var longi=change.doc.data().LON;
		     locate={lat:lati,lng:longi};
		    
			 console.log(locate);
			   
            }	
	  });
  });  
	
	
     
  </script>
</html>
