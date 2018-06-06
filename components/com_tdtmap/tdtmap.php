<?php
	defined('_JEXEC') or die;
?>

<?php 
	$document = JFactory::getDocument();
	$style = '#get_location{'
			. 'margin-top:30px;'
			. 'margin-left: 300px;'
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
		<iframe id="google_map"  width="600" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
	</div>
	<script>
		var c = function (pos){
			var lat = pos.coords.latitude,
				long = pos.coords.longitude,
				coords = lat + ', ' + long;

			document.getElementById('google_map').setAttribute('src','https://maps.google.co.uk/?q='+ coords + '&z=13&output=embed');
		}

		document.getElementById('get_location').onclick = function(){
			navigator.geolocation.getCurrentPosition(c);
			return false;
		}
	</script>

</body>
</html>


