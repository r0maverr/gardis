jQuery(function ( $ ){

	var width = $(window).width();
	if ( width < 1904 ) {
		$('.zoom').width(width);
	} else {
		$('.zoom').width('1904px');
	}

});

		var citiesArray = {
			'novosibirsk':{
			name:"Новосибирск",
			xPos:"55.030199",
			yPos:"82.92043"
			},
			'krasnoyarsk':{
			name:"Красноярск",
			xPos:"56.010579",
			yPos:"92.852536"
			}

		}
		
	var currentCity = citiesArray['novosibirsk'];
	var xPosNovosib = currentCity.xPos;
	var yPosNovosib = currentCity.yPos;



function initialize(){

	var styles = [
		{
			"stylers": [
				{
					"saturation": -100
				},
				{
					"gamma": 1
				}
			]
		},
		{
			"elementType": "labels.text.stroke",
			"stylers":     [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "poi.business",
			"elementType": "labels.text",
			"stylers":     [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "poi.business",
			"elementType": "labels.icon",
			"stylers":     [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "poi.place_of_worship",
			"elementType": "labels.text",
			"stylers":     [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "poi.place_of_worship",
			"elementType": "labels.icon",
			"stylers":     [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "road",
			"elementType": "geometry",
			"stylers":     [
				{
					"visibility": "simplified"
				}
			]
		},
		{
			"featureType": "water",
			"stylers":     [
				{
					"visibility": "on"
				},
				{
					"saturation": 50
				},
				{
					"gamma": 0
				},
				{
					"hue": "#cbdce7"
				}
			]
		},
		{
			"featureType": "administrative.neighborhood",
			"elementType": "labels.text.fill",
			"stylers":     [
				{
					"color": "#333333"
				}
			]
		},
		{
			"featureType": "road.local",
			"elementType": "labels.text",
			"stylers":     [
				{
					"weight": 0.5
				},
				{
					"color": "#333333"
				}
			]
		},
		{
			"featureType": "transit.station",
			"elementType": "labels.icon",
			"stylers":     [
				{
					"gamma": 1
				},
				{
					"saturation": 50
				}
			]
		}
	];

        var styledMap = new google.maps.StyledMapType(styles,
                {name: "FIT LAB"});

        var mapOptions = {
            zoom: 12,
            disableDefaultUI: true,
            center: new google.maps.LatLng(xPosNovosib,yPosNovosib),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            navigationControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            scaleControl: false,
            scrollwheel: false
        };
		var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');

		for(var i in citiesArray){
			var city = citiesArray[i];
			var myLatlng = new google.maps.LatLng(city.xPos,city.yPos);
			var marker = new google.maps.Marker({
				position: myLatlng,
				animation: google.maps.Animation.DROP,
				//icon: '/contacts/marker.png',
				title: city.name
			});
			marker.setMap(map);
			
		}
				
	}


jQuery(document).ready(function() {


	jQuery('button').click(function(){
	
	var city = $(this).attr('id');


	currentCity = citiesArray[city];
	xPosNovosib = currentCity.xPos;
	yPosNovosib = currentCity.yPos;

	initialize();
	});

});


