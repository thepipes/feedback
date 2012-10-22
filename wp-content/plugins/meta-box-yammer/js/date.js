jQuery( document ).ready( function($) 
{
	$( '.rwmby-date' ).on(
		 'focusin'
		,function( handler )
		{
			var 
				$this = $( this ),
				format = $this.attr( 'rel' )
			;

			$this.datepicker(
			{
				showButtonPanel:	true,
				dateFormat:			format
			} );
		}
	);
} );