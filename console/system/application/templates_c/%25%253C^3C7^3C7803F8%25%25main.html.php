<?php /* Smarty version 2.6.19, created on 2013-03-11 14:09:40
         compiled from main.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">
    Ext.onReady(function () {
        // ext addons settings
        Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
        Ext.QuickTips.init();
        // ajax settings
        Ext.Ajax.disableCaching = true;
        Ext.Ajax.timeout = 180000;
        // current date
        date_today = new Date().format(\'Y-m-d\');
        // viewport
        viewport = new Viewport();
        viewport.init();
        viewport.construct_ui();
    });
    // fade out preloader
    setTimeout(function () {
        Ext.get(\'preload\').remove();
        Ext.get(\'preload-mask\').fadeOut({remove:true});
    }, 500);
    // initialize pretty photo
    $(document).ready(function () {
        $("a[rel^=\'prettyPhoto\']").prettyPhoto();
    });
</script>'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>