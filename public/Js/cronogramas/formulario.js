$(function()
{
	var PUNTOS = $.parseJSON(JSON.stringify($('select[name="Id_Jornada"]').data('json')));
	var latitud = 4.666575;
    var longitud = -74.125786;
    var zoom = $('select[name="Id_Punto"]').data('value') == '' ? 11 : 13;
	
	var map = new google.maps.Map($("#map").get(0), {
      center: {lat: latitud, lng: longitud},
      zoom: zoom
    });

    var marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {lat: latitud, lng: longitud}
    });

	var populateJornada = function()
	{
		var deferred = $.Deferred();
		var Id_Punto = $('select[name="Id_Punto"]').val();
		var punto = $.grep(PUNTOS, function(punto)
		{
			return punto.Id_Punto == Id_Punto;
		})[0];

		$('select[name="Id_Jornada"]').html('<option value="">Seleccionar</option>');

		if(punto)
		{
			latitud = parseFloat(punto.Latitud);
			longitud = parseFloat(punto.Longitud);

			$.each(punto.jornadas, function(i, jornada)
			{
				$('select[name="Id_Jornada"]').append('<option value="'+jornada.Id_Jornada+'">'+jornada.Label+'</option>');
			});
			
			map.setCenter({lat: latitud, lng: longitud});
			marker.setPosition({lat: latitud, lng: longitud});
			map.setZoom(13);
		}
		deferred.resolve();

		return deferred;
	}

	var procesarJornada = function()
	{
		var Id_Punto = $('select[name="Id_Punto"]').val();
		var Id_Jornada = $('select[name="Id_Jornada"]').val();
		var punto = $.grep(PUNTOS, function(punto)
		{
			return punto.Id_Punto == Id_Punto;
		})[0];

		var jornada = $.grep(punto.jornadas, function(jornada)
		{
			return jornada.Id_Jornada == Id_Jornada;
		})[0];

		$('input[name="Desde"]').attr('data-fecha-inicio', '').attr('data-fecha-fin', '');
		$('input[name="Hasta"]').attr('data-fecha-inicio', '').attr('data-fecha-fin', '');

		if(jornada)
		{
			if (jornada.Fecha_Evento_Inicio)
		    {
				var fecha_inicio = moment(jornada.Fecha_Evento_Inicio);//.subtract(1, 'days');
				$('input[name="Desde"]').attr('data-fecha-inicio', fecha_inicio.format('YYYY-MM-DD'));
				$('input[name="Hasta"]').attr('data-fecha-inicio', fecha_inicio.format('YYYY-MM-DD'));
		    }

			if (jornada.Fecha_Evento_Fin)
			{
				var fecha_fin = moment(jornada.Fecha_Evento_Fin);//.add(1, 'days');
				$('input[name="Desde"]').attr('data-fecha-fin', fecha_fin.format('YYYY-MM-DD'));
				$('input[name="Hasta"]').attr('data-fecha-fin', fecha_fin.format('YYYY-MM-DD'));
			}
		}
	}


    $('select[name="Id_Jornada"]').on('change', procesarJornada);
    $('select[name="Id_Punto"]').on('change', function(e)
	{
		populateJornada().then(function()
		{
			$('select[name="Id_Jornada"]').val($('select[name="Id_Jornada"]').data('value')).trigger('change');
		});
	});

	if ($('select[name="Id_Punto"]').data('value') != '')
	{
		populateJornada().then(function()
		{
			$('select[name="Id_Jornada"]').val($('select[name="Id_Jornada"]').data('value')).trigger('change');
		});
	}
});