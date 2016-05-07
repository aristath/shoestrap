jQuery( document ).ready( function() {

	_.each( shoestrap.templates, function( args, tmpl ) {

		var postTemplate = wp.template( tmpl );

		if ( false === args.data ) {
			jQuery( args.element ).append( postTemplate( shoestrap.data ) );
		} else {
			jQuery( args.element ).append( postTemplate( args.data ) );
		}

	});

});
