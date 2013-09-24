/**
 *
 * Descrição:Script modulo
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 05-Sep-2013
 *
 * @version 1.0.0
 *
 */
jQuery(function() {
    /*
     * Variaveis e objetos
     */
    var oTable = jQuery('#table-controller'),
        bt_novo_controller = jQuery("#bt_novo_controller"),
        bt_excluir_controller = jQuery("#bt_excluir_controller"),
        id_controller = ""
    ;
    /*
     * Carregamento padrão do grid.
     */
    jQuery(document).loadGrid(oTable);
    /*
     * Evento click único na linha do grid.
     */
    jQuery(document).on("click", "#table-controller tbody tr", function() {
        var anSelected ='#' + jQuery(this).attr("id");
        if (jQuery(anSelected).hasClass('table-tr-selected')) {
            jQuery(anSelected).removeClass('table-tr-selected');
            bt_excluir_controller.addClass("disabled");
            id_controller = "";
        }else {
            jQuery('#table-controller tbody tr.table-tr-selected').removeClass('table-tr-selected');
            jQuery(anSelected).addClass('table-tr-selected');
            bt_excluir_controller.removeClass("disabled");
            id_controller = jQuery(this).attr("id");
        }
    });
    /*
     * Evento clique duplo na linha do grid.
     */
    jQuery(document).on("dblclick", "#table-controller tbody tr", function() {
        var action = jQuery(this).attr("rel");
        jQuery.ajax({
            type : "POST",
            cache: false,
            url  :  action,
            success: function(html, textStatus) {
                if (textStatus === "error") {
                    return;
                }
               bootbox.dialog({
                    message  : html,
                    title    : 'Editar Controller',
                    backdrop : false,
                    size     : "p"
                });
            }
        });
    });
    /*
     * Botão novo modulo
     */
    bt_novo_controller.click(function() {
        var action = baseUrl + jQuery(this).attr("rel");
        jQuery.ajax({
            type : "POST",
            cache: false,
            url  :  action,
            success: function(html, textStatus) {
                if (textStatus === "error") {
                    return;
                }
               bootbox.dialog({
                    message  : html,
                    title    : 'Cadastrar Controller',
                    backdrop : false,
                    size     : "p"
                });
            }
        });
    });
    /*
     * Botão excluir modulo
     */
    bt_excluir_controller.click(function() {
        if(id_controller !== ""){
            var action = baseUrl + '/administrativo/excluir.controller/id_controller/'+id_controller;
            jQuery.ajax({
                type : "POST",
                cache: false,
                url  :  action,
                success: function(html, textStatus) {
                    if (textStatus === "error") {
                        return;
                    }
                    location.reload();
                }
            });
        }
    });
});
