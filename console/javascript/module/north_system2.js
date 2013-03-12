//
// north system
// 
function North_System2() {

    //
    // controller section
    //

    // init
    this.init = function () {
        // predefine menu to attach to button
        var config = new Object({
            id:'north_system_menu2',
            url:base_url + '/_core:menu/get/zarzadzaj'
        });
        this.ui_menu = new Menu();
        this.ui_menu.init(config);

        // defining temporary menu value
        var menu = this.ui_menu.display;

        // here we construct ui
        var config = new Object({
            iconCls:'brick',
            text:'Zarządzaj',
            menu:menu
        });
        this.ui = new Button();
        this.ui.init(config);
    }

}