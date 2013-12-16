jQuery(function(){
    jQuery.rvFontsize({
        targetSection: 'html',
        store: true,
        controllers: {
            appendTo:  '#rvfs-controllers',
            showResetButton: true, 
            template : '<ul class="in-line"><li title="Aumentar letra"><a id="bt_aumentar_fonte" class="rvfs-increase" href="#aumentar_fonte"><i class="fa fa-font"></i><i class="fa fa-plus"></i> aumentar letra</a></li><li title="Diminuir letra"><a id="bt_diminuir_fonte" class="rvfs-decrease" href="#diminuir_fonte"><i class="fa fa-font"></i><i class="fa fa-minus"></i> diminuir letra</a></li><li title="Tamanho normal"><a id="bt_fonte_padrao" class="rvfs-reset" href="#fonte_padrao"><i class="fa fa-font"></i> tamanho normal</a></li><li title="Alto contraste"><a id="bt_auto_contraste" href="#alto_contraste"><i class="fa fa-adjust"></i> alto contraste</a></li><li title="P&aacute;gina de acessibilidade"><a id="bt_pg_acessibilidade" href="#alto_contraste"><i class="fa fa-wheelchair"></i> p&aacute;gina de acessibilidade</a></li></ul>'
        }
    }); 
});