<?php 
    defined('_JEXEC') or die;
?>
<?php 
    $document = JFactory::getDocument();
    $style_map = '#map{'
            . 'width: 700px;'
            . 'height: 400px;'
            . '}';
    $style_samping = '.samping{'
                .'top: 90px;'
                .'margin-top:10px;'
                .'right: 0px;'
                .'width: 100%;'
                .'height: 50%;'
                .'overflow: auto;'
                .'}';
    $sampingdiv = '.samping div{'
            . 'width: 100%;'
            . 'padding: 10px;'
            .'box-sizing: border-box;'
            . '}';
    $rute = '#pano,#rute {'
            . ' width: 50%;'
            . ' height: 600px;'
            .'display: inline-block;'
            .'vertical-align: top;'
            .'margin_left:10px;'
            . '}';
    $body = 'html, body{'
            .'height: 100%;'
            .'margin: 0;'
            .'padding:0;'
            . '}';
    $form = '#form{'
            . '}';
    $document->addStyleDeclaration($style_samping);
    $document->addStyleDeclaration($style_map);
    $document->addStyleDeclaration($sampingdiv);
    $document->addStyleDeclaration($rute);
    $document->addStyleDeclaration($body);
    $document->addStyleDeclaration($form);

 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</head>
<body>
  
<div id="map"></div>
    
<div class="samping">
    <div id="form">
        <h3>Adress</h3>
        <input type="text" id="loca" value="Thanh hóa"/>
        <button id="cari">Tìm kiếm</button>
    </div>          
</div>
        
<div id="pano"></div><div id="rute"></div>
        
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCj2GrDSBy6ISeGg3aWUM4mn3izlA1wgt0&language=vi&region=VN"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script><script>


var perusahaan = [{
        "adress": "Hà nội,VietNam",
    },
];
 
var rute = []; 


function initialize() {
    streetViewService = new google.maps.StreetViewService();
    panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'));
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 21.027764,
            lng: 105.834160
        },
        zoom: 8,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        }
    });
}

google.maps.event.addDomListener(window, 'load', initialize);

function hapusRute() {
    for (var i = 0; i < rute.length; i++) {
        rute[i].setMap(null)
    }
}

function jarak() {
    var a = new google.maps.DirectionsService();
    var b = new google.maps.DirectionsRenderer({
        preserveViewport: true
    });
    b.setMap(map);
    b.setPanel(document.getElementById('rute'));
    rute.push(b);
    var request = {
        origin: "21.071701,105.773898",
        destination: locationofme,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    a.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            b.setDirections(response);
        }
    });

}


function jarakTerdekat(dari, callback) {
    var ke = perusahaan.map(function(obj) {
        return obj.adress;
    });
    var distanceService = new google.maps.DistanceMatrixService();
    distanceService.getDistanceMatrix({
            origins: [dari],
            destinations: ke,
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            durationInTraffic: false,
            avoidHighways: false,
            avoidTolls: false
        },
        function(response, status) {
            if (status !== google.maps.DistanceMatrixStatus.OK) {
                alert('Error:', status);
            } else {
                var tes = response.rows[0].elements.map(function(obj) {
                    return obj.distance.value;
                });
                var min = Math.min.apply(null, tes);
                callback(arraySearch(tes, min));
            }
        });
}

function arraySearch(arr, val) {
    for (var i = 0; i < arr.length; i++)
        if (arr[i] === val)
            return i;
    return false;
}


$(function() {
    $("#cari").click(function() {
        locationofme = ($("#loca").val() == '' ? locationofme : $("#loca").val());
        $("#rute").empty();
        hapusRute();
        jarakTerdekat($("#loca").val(), function(data) {
            jarak(perusahaan[data].adress);
        });
    });

   
});</script>
    </body>
</html>