<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Map Clone</title>
	<meta name="viewport" content="width=device-width, initital-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />

	<script src="../layout/scripts/mapp.js"></script>
	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">

	<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>

	<style>
		body{
			margin: 0;
		}
		#map{
			border: solid 1px;
			height: 51.5vh;
			width: 37vw;
		}
		label{
			margin-top: 0px;
			margin-bottom: 0px;
		}
		
	</style>
</head>
<body>

		<div id="map"></div>
		<script>
			mapboxgl.accessToken = 'pk.eyJ1IjoibWluaHFsZWUxNzk0IiwiYSI6ImNrbXczc3YyNjBiYTQyb3Fpajc3eXYxd20ifQ.x4QKNZ1UMZKbqtPvH6YpAQ';
			var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v12'
			});
			navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
				enableHighAccuracy: true
			})
			function successLocation(position){
				setupMap([position.coords.longitude, position.coords.latitude])
			}
			function errorLocation(){
				setupMap([106.66487132924256, 10.752213800271146])
				// ip trường: 106.66667802659512, 10.797289338053023
			}

			function setupMap(center){

			var map = new mapboxgl.Map({
			  container: "map",
			  style: "mapbox://styles/mapbox/streets-v11",
			  center: center,
			  zoom: 12,

			})
			const nav = new mapboxgl.NavigationControl()
			map.addControl(nav)
			
			var directions = new MapboxDirections({
			  accessToken: mapboxgl.accessToken
			});
			map.addControl(directions, 'top-left');
			}
		</script>


	


	

		
</body>
</html>