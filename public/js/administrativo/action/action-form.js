/**
 *
 * Descrição:Script action-form
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 26-Sep-2013
 *
 * @version 1.0.0
 *
 */
jQuery(function(){
    /*
     * Objetos e variáveis
     */
    var fk_controller = jQuery("#fk_controller"),
        id_controller = jQuery("#id_controller"),
        class_bt_tipo_action = jQuery(".bt-tipo-action"),
        class_tipo_menu = jQuery(".tipo-menu"),
        tipo_action_botao = jQuery("#tipo_action_botao"),
        tipo_action_formulario = jQuery("#tipo_action_formulario"),
        tipo_action_funcao = jQuery("#tipo_action_funcao"),
        div_tipo_menu = jQuery("#div_tipo_menu"),
        tipo_menu_listagem = jQuery("#tipo_menu_listagem"),
        tipo_menu_formulario = jQuery("#tipo_menu_formulario"),
        div_nome_action = jQuery("#div_nome_action"),
        nome_action = jQuery("#nome_action"),
        div_id_action = jQuery("#div_id_action"),
        id_action = jQuery("#id_action"),
        div_rel_controller = jQuery("#div_rel_controller"),
        rel_controller = jQuery("#rel_controller"),
        div_rel_action = jQuery("#rel_action"),
        codigo_action = jQuery("#codigo_action"),
        formAction = jQuery("#formAction")
    ;
    /*
     * Select controller.
     */
    fk_controller.magicSuggest({
        width            : 350,
        allowFreeEntries : false,
        maxSelection     : 1,
        useZebraStyle    : true,
        expandOnFocus    : true,
        emptyText        : 'Selecione o controlador.',
        noSuggestionText : 'Não foi localizado nenhum item com o termo informado.',
        data             : listaControllers()
    });
    /*
     * Retorna a listagem de controllers para o select.
     */
    function listaControllers(){
        var myjson = [];
        jQuery.ajax({
            type     : "POST",
            cache    : false,
            dataType : 'json',
            url      : baseUrl + '/administrativo/listagem.controller/',
            async    : false,
            success: function(dados) {
                jQuery.each(dados,function(i, item){
                    myjson.push({
                        name: item.nome_controller,
                        id  : item.id_controller
                    });
                });
            }
        });
        return myjson; 
    };
    /*
     * Manipulação de tipo e tipo menu. O tipo menu só está disponível 
     * se o tipo for botão.
     */
    class_bt_tipo_action.click(function(event){
        event.preventDefault();
        if(jQuery(this).attr('id') === 'tipo_action_botao'){
            div_tipo_menu.fadeIn('fast');
        }else{
            div_tipo_menu.fadeOut('fast');
            class_tipo_menu.attr("checked" , false );
        }
    });
    /*
     * Salvar
     */
    jQuery("#salvarAction").on("click",function(){
        if(validaCampos()){
            formAction.submit();
        }
    });
    /*
     * Validação de campos front-side
     */
    function validaCampos(){
       return true; 
    }
    /*
     * Ajuda 
     */
    jQuery("#helpControladorField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Vincula a action a um controller.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpCodigoActionField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Identificar&aacute; a qual action a a&ccedil;&atilde;o pertecer&aacute;. Infome o identificador definido no c&oacute;digo do sistema.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpTipoField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Define se a action ser&aacute; um bot&atilde;o, formul&aacute;rio ou fun&ccedil;&atilde;o.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpTipoMenuField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Caso a action seja do tipo bot&atilde;o, define se ser&aacute; para a listagem ou formul&aacute;rio.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpNomeField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Nome da action que ser&aacute; visualizada pelo usu&aacute;rio</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpCodigoIdentificadorField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Identificador da action para o sistema. No caso de bot&otilde;es, esse c&oacute;digo poder&aacute; ser usado para manipula&ccedil;&otilde;es do DOM com jQuery.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpNomeControladorField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Usado para definir o Controller da action. No c&oacute;digo do sistema, esse campo ser&aacute; utilizado para forma&ccedil;&atilde;o do link definindo o controller da a&ccedil;&atilde;o.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpNomeAcaoField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Usado para definir a Action. No c&oacute;digo do sistema, esse campo ser&aacute; utilizado para forma&ccedil;&atilde;o do link definindo a action no controller.</i><br />Padr&atilde;o: [nome.controller]<br />Ex.: salvar.action',
        title     : 'Ajuda'
    });
    jQuery("#helpClasseBotaoField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Define a classe visual do bot&atilde;o no formul&aacute;rio.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpClasseIconeField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Classe que ser&aacute; utilizada para adicionar um icone caso a action seja um bot&atilde;o.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpDescricaoField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Descri&ccedil;&atilde;o da a&ccedil;&atilde;o.</i>',
        title     : 'Ajuda'
    });
    jQuery("#helpOrdemField").popover({
        animation : true,
        html      : true,
        trigger   : 'hover',
        content   : '<i>Define a ordem de visualiza&ccedil;&atilde;o no formul&aacute;rio.</i>',
        title     : 'Ajuda'
    });
});