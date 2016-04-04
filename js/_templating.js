jQuery( document ).ready( function() {

	_.each( shoestrap.templates, function( args, tmpl ) {

		var post_template = wp.template( tmpl );

		if ( false === args.data ) {
			jQuery( args.element ).append( post_template( shoestrap.global_data ) );
		} else {
			jQuery( args.element ).append( post_template( args.data ) );
		}

	});

});
