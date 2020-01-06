$(function(){

	// Lista de centrales generadoras
	$.post( 'Centr_Gener.php' ).done( function(respuesta)
	{
		$( '#Cen_gen' ).html( respuesta );
	});

	// lista de unidades generadoras	
	$('#Cen_gen').change(function()
	{
		var la_central = $(this).val();
		
		// Lista de unidades
		$.post( 'Unid_Gener.php', { central: la_central} ).done( function( respuesta )
		{
			$( '#unid_gen' ).html( respuesta );
		});
	});
	
	// datos de la unidad
	$( '#unid_gen' ).change( function()
	{
		var la_unidad = $(this).val();
		// datos de la unidad
		$.post( 'datos_unidad.php', { unidad: la_unidad} ).done( function( respuesta )
		{
			$( '#datos_unidad' ).html( respuesta );
		});
	});
})



