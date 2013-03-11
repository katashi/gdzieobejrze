<?php /* Smarty version 2.6.19, created on 2013-03-11 13:26:32
         compiled from home.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "extension/header_home.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="wrapper">
    <!-- header -->
    <div id="header">
        <div id="max-width">
            <ul class="sf-menu">
                <li><a href="#">O nas</a></li>
                <li><a href="#">Dodaj sklep</a></li>
                <li><a href="#">Współpraca</a></li>
                <li><a href="#">Regulamin</a></li>
                <li><a href="#">Pomoc</a></li>
                <li><a href="#">Forum</a></li>
                <li><a href="#">Kontakt</a></li>
                <li><a class="log" href="#"><span style="color:black;">Logowanie</span></a></li>
            </ul>
        </div>
        <div id="line"></div>
        <!-- end header -->
        <!-- content -->
        <div id="content">
            <img alt="logo Gdzie Obejrze" height="111" src="<?php echo $this->_tpl_vars['site_url']; ?>
images/logo-gdzie-obejrze.png" width="153"/><br/>
            <span id="logo-napis">  gdzie<span>obejrze</span>.pl</span><br/>
            <br/>
            <div id="slogan"> Contrary to popular belief, Lorem Ipsum.
            </div>
            <div id="boxes">
                <div id="box1" style="">Znajdź przedmiot<br/>
                    <input onfocus="if(this.value=='Samsung LCD 43 HD') this.value='';" onblur="if(this.value=='') this.value='Samsung LCD 43 HD';" value="Samsung LCD 43 HD"/><a href="#" class="button">Wybierz z kategorii </a>
                </div>
                <div id="box2" style="">Podaj lokalizację<input
                        onfocus="if(this.value=='Bez lokalizacji') this.value='';" onblur="if(this.value=='') this.value='Bez lokalizacji';" value="Bez lokalizacji"/>
                </div>
                <div id="box3" style="">Wybierz zasięg poszukiwań
                    <div class="button-holder">
                        <input type="radio" id="radio-1-1" name="radio-1-set" class="regular-radio" checked/><label for="radio-1-1"></label>&nbsp;1km &nbsp;&nbsp;
                        <input type="radio" id="radio-1-2" name="radio-1-set" class="regular-radio"/><label for="radio-1-2"></label>&nbsp;5 km&nbsp;&nbsp;
                        <input type="radio" id="radio-1-4" name="radio-1-set" class="regular-radio"/><label for="radio-1-4"></label>&nbsp;15 km
                        <div style="float:right"><input
                                onfocus="if(this.value=='Zasięg w km') this.value='';" onblur="if(this.value=='') this.value='Zasięg w km';" value="Zasięg w km"/>
                        </div>
                    </div>
                </div>
            </div>
            <div id="boxes-lines">
                <a href="#">
                    <img id="tras" alt="szukaj" height="58" src="<?php echo $this->_tpl_vars['site_url']; ?>
images/trans.png" width="210"/></a></div>
        </div>
        <!-- end content -->
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "extension/footer_home.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>