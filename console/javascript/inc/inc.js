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
    column.push({ id:'options', header:'Opcje', renderer:obj.option, sortable:false, menuDisabled:true });
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
            allowBlank:true,
            fieldLabel:field[i],
            name:field[i],
            xtype:'textfield'
        });
        item.push(tmp);
    }
    return item;
}
function Form_Add_Button_Create(obj) {
    var button = Array();
    var tmp = new Object({
        iconCls:'x-btn-text-icon add',
        text:'Dodaj',
        listeners:{
            click:function (btn, e) {
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
        iconCls:'x-btn-text-icon disk',
        text:'Zapisz',
        listeners:{
            click:function (btn, e) {
                obj.edit(obj);
            }
        }
    });
    button.push(tmp);
    return button;
}
//function to render field active yes or no
function render_active_field(value, p, record) {
    if (value == 1) {
        return String.format('Tak');
    } else {
        return String.format('Nie');
    }
}

function category_all_store(obj){
    // store
    var fields = new Array('id', 'title');
    var config = new Object({
        fields: fields,
        format: 'json',
        id: 'category_all_store',
        url: base_url+'/'+'gdzieobejrze'+':product_dict_category'+'/load_all'
    });
    return config;
}
function vendor_all_store(obj){
    // store
    var fields = new Array('id', 'title');
    var config = new Object({
        fields: fields,
        format: 'json',
        id: 'vendor_all_store',
        url: base_url+'/'+'gdzieobejrze'+':product_dict_vendor'+'/load_all'
    });
    return config;
}
// function dedicated to create custom
// functionalities in grid paging toolbar
// we can put it here various themes (configs)
// to versatile options and possibilities
function Ptb_Create(obj) {
    if (obj._ptb_mode == 'default') {
        var config = new Object({
            store:obj.store.display,
            items:['-',
                {
                    iconCls:'x-btn-text-icon add',
                    text:'Dodaj',
                    listeners:{
                        click:function (ptb, e) {
                            obj.add(obj);
                        }
                    }
                }
            ]
        });
    }
    if (obj._ptb_mode == 'image') {
        var config = new Object({
            store:obj.store.display,
            items:['-',
                {
                    iconCls:'x-btn-text-icon camera_add',
                    text:'Dodaj Obrazek',
                    listeners:{
                        click:function (ptb, e) {
                            obj.media_add(obj);
                        }
                    }
                }, '-',
                {
                    iconCls:'x-btn-text-icon folder_add',
                    text:'Dodaj Katalog',
                    listeners:{
                        click:function (ptb, e) {
                            obj.directory_add(obj);
                        }
                    }
                }

            ]
        });
    }
    return config;
}

// image_update for edition
function image1_update(obj) {
    var form = obj.display;
    var image = form.getForm().findField('image1').getValue();
    if (image) {
        var image_image = form.findById('image_image_wae1');
        image_image.update('<img src="../media/image/100x75/' + image + '" border="1">');
    }
}
function image2_update(obj) {
    var form = obj.display;
    var image = form.getForm().findField('image2').getValue();
    if (image) {
        var image_image = form.findById('image_image_wae2');
        image_image.update('<img src="../media/image/100x75/' + image + '" border="1">');
    }
}
function image3_update(obj) {
    var form = obj.display;
    var image = form.getForm().findField('image3').getValue();
    if (image) {
        var image_image = form.findById('image_image_wae3');
        image_image.update('<img src="../media/image/100x75/' + image + '" border="1">');
    }
}
function image4_update(obj) {
    var form = obj.display;
    var image = form.getForm().findField('image4').getValue();
    if (image) {
        var image_image = form.findById('image_image_wae4');
        image_image.update('<img src="../media/image/100x75/' + image + '" border="1">');
    }
}
function image5_update(obj) {
    var form = obj.display;
    var image = form.getForm().findField('image5').getValue();
    if (image) {
        var image_image = form.findById('image_image_wae5');
        image_image.update('<img src="../media/image/100x75/' + image + '" border="1">');
    }
}

