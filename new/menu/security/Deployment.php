<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Map Tracing</title>
  <style>
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>
<body>
  <h1>Map Tracing</h1>
  <div id="map"></div>

  <script>
    function initMap() {
      const mapContainer = document.getElementById("map");
      
      // Check if geolocation is supported
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(position => {
          const userCoordinates = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          const iframe = document.createElement("iframe");
          iframe.src = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d849.3869410955546!2d86.24792737652712!3d22.801367835072572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f5e3cc096696bf%3A0x79adf865e45ee599!2sMANIPAL%20TATA%20MEDICAL%20COLLEGE!5e1!3m2!1sen!2sin!4v1715665582038!5m2!1sen!2sin&z=15&q=${userCoordinates.lat},${userCoordinates.lng}`;
          iframe.width = "800";
          iframe.height = "600";
          iframe.style.border = "0";
          iframe.allowfullscreen = "";
          iframe.loading = "lazy";
          iframe.referrerpolicy = "no-referrer-when-downgrade";
          mapContainer.appendChild(iframe);
        }, error => {
          console.error("Error getting user location:", error);
          mapContainer.textContent = "Unable to retrieve your location.";
        });
      } else {
        mapContainer.textContent = "Geolocation is not supported by your browser.";
      }
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
</body>
</html>
