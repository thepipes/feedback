jQuery( document ).ready( function($)
{
	// Object containing all the plupload uploaders
	var 
		rwmby_image_uploaders	= {},
		hundredMB				= null,
		max						= null,
		throbbers				= {}
	;
	// Hide "Uploaded files" title as long as there are no files uploaded
	if ( 1 == $( '.rwmby-uploaded' ).children().length )
		$( '.rwmby-uploaded-title' ).addClass( 'hidden' );
	// Check on mouseenter & -leave if we got files and add the "Uploaded files" title
	$( '.rwmby-drag-drop' ).bind(
		'mouseenter mouseleave', 
		function() 
		{
			if ( 1 < $( '.rwmby-uploaded' ).children().length )
				$( '.rwmby-uploaded-title' ).removeClass( 'hidden' );
		}
	);
	$( '.rwmby-delete-file' ).bind(
		'click',
		function()
		{
			if ( 1 >= $( '.rwmby-uploaded' ).children().length )
				$( '.rwmby-uploaded-title' ).addClass( 'hidden' );
		}
	);
	
	//helper functions
	//removes li element if there is an error with the file
	function removeError(file) 
	{
		$('li#' + file.id)
			.addClass('rwmby-image-error')
			.delay(1600)
			.fadeOut( 'slow', function() 
				{
					$(this).remove();
				}
			);
	}
	//Adds loading li element
	function addLoading (up, file)
	{
		$list =  $( '#' + up.settings.container ).find( 'ul' );
		$list.append("<li id='" + file.id + "'><div class='rwmby-image-uploading-bar'></div><div id='" + file.id + "-throbber' class='rwmby-image-uploading-status'></div></li>");
	}
	//Adds loading throbber while waiting for a response
	function addThrobber(file)
	{
		throbbers[file.id] = new CanvasLoader(file.id + '-throbber');
		throbbers[file.id].setDiameter(50);
		throbbers[file.id].show();
		$('#canvasLoader', '#' + file.id + '-throbber')
			.css('position', 'absolute')
			.css('top', function(){
				return throbbers[file.id].getDiameter() * -0.5 + "px";
			})
			.css('left', function(){
				return throbbers[file.id].getDiameter() * -0.5 + "px";
			});
	}
	
	// Using all the image prefixes
	$( 'input:hidden.rwmby-image-prefix' ).each( function()
	{
		var 
			prefix = $( this ).val(),
			nonce = $('input#nonce-upload-images_' + prefix).val();
		// Adding container, browser button and drag ang drop area
		rwmby_plupload_init = $.extend(
			{
				container:		prefix + '-container',
				browse_button:	prefix + '-browse-button',
				drop_element:	prefix + '-dragdrop'				
			},
			rwmby_plupload_defaults
		);
		// Add field_id to the ajax call
		rwmby_plupload_init['multipart_params'] =
		{	
			action : 'plupload_image_upload',
			field_id: prefix,
			_ajax_nonce: nonce,
			post_id: $('input#post_ID').val()
		};
		// Create new uploader
		rwmby_image_uploaders[ prefix ] = new plupload.Uploader( rwmby_plupload_init );
		rwmby_image_uploaders[ prefix ].init();

		rwmby_image_uploaders[ prefix ].bind(
			'FilesAdded', 
			function( up, files )
			{
				hundredMB	= 100 * 1024 * 1024, 
				max			= parseInt( up.settings.max_file_size, 10 );
				plupload.each(
					files, 
					function( file )
					{
						addLoading(up, file);
						addThrobber(file);
						if ( file.size >= max )
						{
							removeError(file);
						}
					} 
				);
				up.refresh();
				up.start();
			}
		);

		rwmby_image_uploaders[ prefix ].bind(
			'Error', 
			function( up, e ) 
			{
				addLoading(up, e.file);
				removeError(e.file);
				up.removeFile(e.file);
			}
		);
		
		rwmby_image_uploaders[ prefix ].bind(
			'UploadProgress', 
			function( up, file ) 
			{
				//update the loading div
				$('div.rwmby-image-uploading-bar', 'li#' + file.id).css('height', file.percent + "%");
			}
		);

		rwmby_image_uploaders[ prefix ].bind(
			'FileUploaded', 
			function( up, file, response ) 
			{
				res = wpAjax.parseAjaxResponse( $.parseXML( response.response ), 'ajax-response' );
				if ( false === res.errors )
				{
					$('li#'+file.id).replaceWith(res.responses[0].data);
				}
				else
				{
					removeError(file);
				}
			});
	});
});