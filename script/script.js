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

//
