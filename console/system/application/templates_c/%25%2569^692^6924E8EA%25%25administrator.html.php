<?php /* Smarty version 2.6.19, created on 2013-03-11 14:13:53
         compiled from _core/administrator.html */ ?>
<script type="text/javascript"><?php echo '

function Administrator() {

    // var
    this._dir = \''; ?>
<?php echo $this->_tpl_vars['_dir']; ?>
<?php echo '\';
    this._field = JSON.parse(\''; ?>
<?php echo $this->_tpl_vars['field']; ?>
<?php echo '\');
    this._id = \''; ?>
<?php echo $this->_tpl_vars['_id']; ?>
<?php echo '\';
    this._name = \''; ?>
<?php echo $this->_tpl_vars['_name']; ?>
<?php echo '\';
    this._path = base_url+\'/\'+this._dir+\':\'+this._name;
    this._ptb_mode = \'default\';

    // crud
    this.add = function(obj) {
        id = obj._id+\'_add_\'+Math.floor((Math.random()*999999999)+1);
        title = \'Dodaj\';
        path = obj._path+\'/display_add\';
        center.ui.tab_add(id, title, path);
    }
    this.edit = function(obj, id, user) {
        id = obj._id+\'_edit_\'+id;
        title = \'Edycja \'+user;
        path = obj.path+\'/display_edit/\'+id;
        center.ui.tab_add(id, title, path);
    }
    this.option = function(value,m,record,ri,ci,store) {
        return String.format(\'<a href="javascript:Grid_Delete(\\\'\'+store.name+\'\\\',\\\'\'+store.path+\'/delete/\'+record.data.id+\'\\\');"><img src="images/icon/delete.png" border="0"></a>\');
    }

    // store
    var config = new Object({
        fields: this._field,
        id: this._name,
        name: this._name,
        path: this._path,
        url: this._path+\'/load_all\'
    });
    this.store = new Store(); this.store.init(config);

    // grid
    this.ptb = new PagingToolBar(); this.ptb.init(Ptb_Create(this));
    var config = new Object({
        store: this.store.display,
        tbar: this.ptb.display,
        columns: new Grid_Columns_Create(this)
    });
    this.grid = new EditorGridPanel(); this.grid.init(config);

    // panel/load
    var config = new Object({items:[this.grid.display]});
    this.panel = new Panel(); this.panel.init(config);
    this.panel.display.render(Ext.get(this._id));
    this.store.display.load({params:{start:0,limit:_paging_limit}});

}
//
var administrator = new Administrator();
//
'; ?>
</script>
<div id="<?php echo $this->_tpl_vars['_id']; ?>
"></div>