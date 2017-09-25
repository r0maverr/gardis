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
			xPos:"54.959412",
			yPos:"83.056728",
			header:"Наши дилеры в Новосибирске",
				dealers:[{
					name:"ООО «ПГС-К»",
					xPos:"54.959412",
					yPos:"83.056728",					
				}
			
				]
			},
			'krasnoyarsk':{				
			name:"Красноярск",
			xPos:"56.071745",
			yPos:"92.959741",
			header:"Наши дилеры в Красноярске",
			dealers:[{
				name:"«Кайман» Производственная группа ",
				xPos:"56.071745",
				yPos:"92.959741",
				
			},
			{
				name:"ЗаборТорг",
				xPos:"56.063585",
				yPos:"92.895942",
				
			}			
			]
			
			}

		}

		
	var currentCity = citiesArray['novosibirsk'];
	var xPosNovosib = currentCity.xPos;
	var yPosNovosib = currentCity.yPos;



function initialize(){

        var mapOptions = {
            zoom: 12,
            disableDefaultUI: true,
            center: new google.maps.LatLng(xPosNovosib,yPosNovosib),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            navigationControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            scaleControl: true,
            scrollwheel: false
        };
		var map = new google.maps.Map(document.getElementById("map"), mapOptions);

		for(var i in citiesArray){
			var city = citiesArray[i];
			
			var deal = city['dealers'];
		
		for(var j in deal){
			
			var d = deal[j];
			
			var myLatlng = new google.maps.LatLng(d.xPos,d.yPos);
			var marker = new google.maps.Marker({
				position: myLatlng,
				animation: google.maps.Animation.DROP,
				//icon: '/contacts/marker.png',
				title: d.name
			});
			marker.setMap(map);	
			
		}	
			

			
		}
				
	}


jQuery(document).ready(function() {

	$( ".city-ar" ).change(function() {

		var city = $(this).val();

		currentCity = citiesArray[city];
		xPosNovosib = currentCity.xPos;
		yPosNovosib = currentCity.yPos;
		$('.mapChangeText').html(currentCity.header);
		
		initialize();
	});

	
	initialize();
});


