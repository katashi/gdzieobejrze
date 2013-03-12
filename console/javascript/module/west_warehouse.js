//
// west warehouse
// 
function West_Warehouse() {
	
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
			id: 'west_warehouse',
			title: 'Magazyn',
			titleCollapse: true
		});
		this.ui = new Panel();
		this.ui.init(config);
		//
		//
		// here we check predefined components for launch ( fixed code - no config )
		//
		//
		if (window._west_article) {
			west_article = new West_Article();
			west_article.init();
			new Helper_Ui().add_ui(this.ui.display, west_article.ui.display);
		}
        if (window._west_product) {
			west_product = new West_Product();
			west_product.init();
			new Helper_Ui().add_ui(this.ui.display, west_product.ui.display);
		}

	}
	
}