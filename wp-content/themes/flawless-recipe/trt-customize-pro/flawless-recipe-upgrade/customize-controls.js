( function( api ) {

	// Extends our custom "flawless-recipe-upgrade" section.
	api.sectionConstructor['flawless-recipe-upgrade'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
