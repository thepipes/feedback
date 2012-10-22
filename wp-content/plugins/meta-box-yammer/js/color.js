jQuery( document ).ready( function($) 
{
	$( '.rwmby-color-picker' ).each( function()
	{
		var $this = $( this ), id = $this.attr( 'rel' );

		$this.farbtastic( '#' + id );
	} );

	$( '.rwmby-color-select' ).click( function()
	{
		$( this ).siblings( '.rwmby-color-picker' ).toggle();
		return false;
	} );
} );