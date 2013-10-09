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
                    myjson.push({name: item.nome_controller , id: item.id_controller});
                });
            }
        });
        return myjson; 
    };
    /*
     * Manipulação de tipo e tipo menu. O tipo menu só está disponível se o tipo for botão.
     * 
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
    /**
     * Salvar
     */
    jQuery("#salvarAction").on("click",function(){
        alert('nada');
//       if(validaCampos()){
            formAction.submit();
//       }
    });
    /*
     * Validação de campos frontside
     * 
     */
    function validaCampos(){
       return true; 
    }
});