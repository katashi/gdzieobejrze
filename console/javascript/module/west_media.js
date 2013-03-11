//
// west media
// 
function West_Media() {
	
	//
	// controller section
	//
	
	// init
	this.init = function() {
		// here we construct ui
		var config = new Object({
			baseCls: 'ks',
			bodyStyle: 'padding: 0px',
			collapsed: false,
			collapsible: true,
			id: 'west_media',
			title: 'Media',
			titleCollapse: true
		});
		this.ui = new Panel();
		this.ui.init(config);
		//
		//
		// here we check predefined components for launch ( fixed code - no config )
		//
		//
		if (window._west_image) {
			west_image = new West_Image();
            west_image.init();
			new Helper_Ui().add_ui(this.ui.display, west_image.ui.display);
		}
		
	}
	
}