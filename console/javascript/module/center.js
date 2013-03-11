//
// center
//
function Center() {

    //
    // controller section
    //

    // init
    this.init = function () {
        var config = new Object({
            id:'center',
            region:'center'
        });
        this.ui = new TabPanel();
        this.ui.init(config);

    }

}