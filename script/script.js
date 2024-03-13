//Metodos para pegar e atualizar localização

function getLocation(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(showPosition);
	}
}

function showPosition(position){
	$('p.lat-txt').html('Latitude: '+position.coords.latitude);
	$('p.lon-txt').html('Longitude: '+position.coords.longitude);
	atualizarCoordenadas(position.coords.latitude,position.coords.longitude);
}

function atualizarCoordenadas(latitudePar,longitudePar){
	//Requisição AJAX para atualizar o banco
	$.ajax({
		url:'/Index/Tinder/atualizar-coord.php',
		method:'post',
		data:{latitude:latitudePar,longitude:longitudePar}
	}).done(function(){
		alert('Localização atualizada com sucesso!');
	})
}

$(function(){

	var myLat = $('.lat-txt').html();
	var myLong = $('.lon-txt').html();
	console.log(myLat+'//'+myLong);

	$('li').each(function(){
		var lat_user = $(this).find('.lat-user').html();
		var long_user = $(this).find('.long-user').html();
		
		var distancia = Math.round(getDistanceFromLatLonInKm(myLat,myLong,lat_user,long_user) * 100) / 100;
		$(this).find('.user-distancia').html(distancia+' Km');
		console.log(distancia);
	})

	function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
	  var R = 6371; // Radius of the earth in km
	  var dLat = deg2rad(lat2-lat1);  // deg2rad below
	  var dLon = deg2rad(lon2-lon1); 
	  var a = 
	    Math.sin(dLat/2) * Math.sin(dLat/2) +
	    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
	    Math.sin(dLon/2) * Math.sin(dLon/2)
	    ; 
	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	  var d = R * c; // Distance in km
	  return d;
	}
	function deg2rad(deg) {
	  return deg * (Math.PI/180)
	}
})


//
