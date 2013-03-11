//
// north
//
function North() {

    //
    // controller section
    //

    // init
    this.init = function () {
        // here we construct ui
        var config = new Object({
            id:'north',
            region:'north'
        });
        this.ui = new Toolbar();
        this.ui.init(config);

        //
        // system
        //
        north_system = new North_System();
        north_system.init();
        new Helper_Ui().add_ui(this.ui.display, north_system.ui.display);

    }

}