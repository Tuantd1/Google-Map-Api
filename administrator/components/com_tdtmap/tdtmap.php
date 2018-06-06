<?php
	defined('_JEXEC') or die;
?>
<?php 
	$document = JFactory::getDocument();
	$style = '#get_location{'
			. 'margin-top:30px;'
			. 'margin-left: 500px;'
			. '}';
	$style_map = '#google_map{'
				.'margin-left:50px;'
				.'margin-top:10px;'
				.'}';
	$document->addStyleDeclaration($style);
	$document->addStyleDeclaration($style_map);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Geolocation</title>
</head>
<body>
	<button href="#" id="get_location">Get Location</button>
	<br>
	<div id="map">
		<iframe id="google_map" style="margin-left:200px; margin-top:20px" width="980" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.455816476745!2d105.73295331455178!3d21.054449385984498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345457e292d5bf%3A0x20ac91c94d74439a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2hp4buHcCBIw6AgTuG7mWk!5e0!3m2!1svi!2s!4v1527852676247" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
	</div>
	<script>
		var c = function (pos){
			var lat = pos.coords.latitude,
				long = pos.coords.longitude,
				coords = lat + ', ' + long;

			document.getElementById('google_map').setAttribute('src','https://maps.google.co.uk/?q='+ coords + '&z=60&output=embed');
		}

		document.getElementById('get_location').onclick = function(){
			navigator.geolocation.getCurrentPosition(c);
			return false;
		}
	</script>

</body>
</html>