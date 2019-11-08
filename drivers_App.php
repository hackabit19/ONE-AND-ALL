<html>
    <head>
         <meta charset="UTF-8"> 
        </head>
  <body>
    <h1>App For Emergency Responders </h1>
	<p>Below Location Will be Updated as emergency occurs .</p>
    <input type="text" id="messages" readonly>
	<a href="" id="lnk">Click For Location</a>
  </body>

  <!-- Include the latest Ably Library  -->
  <script src="https://cdn.ably.io/lib/ably.min-1.js"></script>

  <!-- Instance the Ably library  -->
  <script >
     document.getElementById("lnk").style.display = "none";
    var realtime = new Ably.Realtime("SSRsXA.SgO-gA:8st5DRQ52bcE_-OY"); /* ADD YOUR API KEY HERE */
	    var channel = realtime.channels.get("Accident");
    channel.subscribe(function(msg) {
        var string=msg.data;
		console.log(string);
		var lati=string['lati'];
		var longi=string['longi'];
      console.log("Received: " + JSON.stringify(msg.data));
	  console.log(lati);
	  console.log(longi);
    document.getElementById("messages").value=JSON.stringify(msg.data);
	document.getElementById("lnk").style.display = "block";
	document.getElementById("lnk").href="http://maps.google.com/maps?q="+lati+","+longi;
	});
    
  </script>
</html>
