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
    var fk_controller = jQuery("#fk_controller")
    ;
    /*
     * Select controller.
     */
    fk_controller.magicSuggest({
        width            : 500,
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
});