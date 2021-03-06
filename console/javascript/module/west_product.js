//
// west product
// 
function West_Product() {
	
	//
	// controller section
	//
	
	// init
	this.init = function() {
		// here we construct ui
		var config = new Object({
			collapsible: true,
			title: 'Produkty',
			titleCollapse: true,
			tools: [
			    { id:'save', qtip: 'Dodaj Produkt', handler: this.directory_add },
			    { id:'refresh', qtip: 'Odśwież', handler: this.refresh }
			]
		});
		this.ui = new Panel();
		this.ui.init(config);
		//
		//
		// here we run fixed elements for section
		//
		//
		var config = new Object({
            controller: 'gdzieobejrze:',
			dataUrl: base_url+'/_core:tree/tree_create/product',
			ddGroup: 'product',
            //ddGroupExtended: 'website',
			id: 'product'
		});
		this.ui_tree = new Tree();
		this.ui_tree.init(config);
		new Helper_Ui().add_ui(this.ui.display, this.ui_tree.display);
	}
	
	// directory_add
	this.directory_add = function() {
		new Helper_Ui().add_window('product_directory_add', 'Dodaj katalog', base_url +'/_core:tree/add/product,0');
	}
	
	// refresh content
	this.refresh = function() {
		west_product.ui_tree.root.reload();
		west_product.ui_tree.path_expand();
	}
	
}