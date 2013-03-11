// grid functions are dedicated to handle
// mechanics in grid displays (all of them)
// columns - creates columns :D just like it sounds
// deleted - serves to handle entries removals
function Grid_Columns_Create(obj) {
    var column = Array();
    var field = obj._field;
    var length = field.length;
    element = null;
    for (var i = 0; i < length; i++) {
        var tmp = new Object({
            id:field[i],
            dataIndex:field[i],
            header:field[i],
            sortable:false,
            menuDisabled:true
        });
        column.push(tmp);
    }
    column.push({ id: 'options', header: 'Opcje', renderer: obj.option, sortable: false, menuDisabled: true });
    return column;
}
function Grid_Edit(id, title, url) {
    center.ui.tab_add(id, title, url);
}
function Grid_Delete(objName, url, tree) {
    var obj = eval(objName);
    new Helper_Delete().delete_confirm(url, 'grid', obj.store, tree);
}

// function dedicated to create add form based
// on elements provided straight from database
// add serves to create form (tfields, etc)
// button - obviously to submit filled form
function Form_Add_Item_Create(obj) {
    var item = Array();
    var field = obj._field;
    var length = field.length;
    element = null;
    for (var i = 0; i < length; i++) {
        var tmp = new Object({
            allowBlank: true,
            fieldLabel: field[i],
            name: field[i],
            xtype: 'textfield'
        });
        item.push(tmp);
    }
    return item;
}
function Form_Add_Button_Create(obj) {
    var button = Array();
    var tmp = new Object({
        iconCls: 'x-btn-text-icon add',
        text: 'Dodaj',
        listeners: {
            click: function(btn, e) {
                obj.add(obj);
            }
        }
    });
    button.push(tmp);
    return button;
}
function Form_Edit_Button_Create(obj) {
    var button = Array();
    var tmp = new Object({
        iconCls: 'x-btn-text-icon disk',
        text: 'Zapisz',
        listeners: {
            click: function(btn, e) {
                obj.edit(obj);
            }
        }
    });
    button.push(tmp);
    return button;
}

// function dedicated to create custom
// functionalities in grid paging toolbar
// we can put it here various themes (configs)
// to versatile options and possibilities
function Ptb_Create(obj) {
    if (obj._ptb_mode == 'default') {
        var config = new Object({
            store: obj.store.display,
            items:['-',
                {
                    iconCls: 'x-btn-text-icon add',
                    text: 'Dodaj',
                    listeners: {
                        click: function(ptb, e) {
                            obj.add(obj);
                        }
                    }
                }
            ]
        });
    }
    if (obj._ptb_mode == 'image') {
        var config = new Object({
            store: obj.store.display,
            items:['-',
                {
                    iconCls: 'x-btn-text-icon camera_add',
                    text: 'Dodaj Obrazek',
                    listeners: {
                        click: function(ptb, e) {
                            obj.media_add(obj);
                        }
                    }
                },'-',
                {
                    iconCls: 'x-btn-text-icon folder_add',
                    text: 'Dodaj Katalog',
                    listeners: {
                        click: function(ptb, e) {
                            obj.directory_add(obj);
                        }
                    }
                }

            ]
        });
    }
    return config;
}