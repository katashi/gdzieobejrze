<?php /* Smarty version 2.6.19, created on 2013-03-11 14:09:36
         compiled from login.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">
    function Login() {
        // init
        this.init = function () {
            login_ui = this.construct_ui();
            login_ui.show();
        }
        // init
        this.init_ui = function () {
        }
        // construct
        this.construct_ui = function () {
            form = new Ext.FormPanel({
                bodyStyle:\'padding: 5px\',
                defaults:{
                    maxLength:128,
                    width:300
                },
                frame:true,
                waitMsgTarget:true,
                items:[{
                        allowBlank:false,
                        fieldLabel:\'Użytkownik\',
                        name:\'user\',
                        xtype:\'textfield\'
                    },{
                        allowBlank:false,
                        fieldLabel:\'Hasło\',
                        inputType:\'password\',
                        name:\'password\',
                        xtype:\'textfield\'
                    }
                ],
                buttons:[
                    {
                        handler:submit_FormPanel,
                        text:\'Ok\'
                    }
                ],
                keys:[{
                        key:[Ext.EventObject.ENTER], handler:function () {
                        submit_FormPanel();
                    }
                }]
            });
            var config = new Object({
                bodyStyle:\'padding: 5px\',
                closable: false,
                draggable: false,
                resizable: false,
                title:\'Logowanie\',
                items:[ form ],
                width:455
            });
            return new Ext.Window(config);
        }
    }
    function submit_FormPanel() {
        form.form.submit({
            url:\'index.php/main/index_check\',
            success:function (a, b) {
                if (b.result.success) {
                    location.reload();
                }
            },
            failure:function () {
                Ext.MessageBox.alert(\'Logowanie\', \'Nieprawidłowe dane.\');
            }
        });
    }
    // login
    login = new Login().init();
    // function to fade out preloader
    setTimeout(function () {
        Ext.get(\'preload\').remove();
        Ext.get(\'preload-mask\').fadeOut({remove:true});
    }, 500);
</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>