/**
 *
 * Descrição:Script action
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 24-Sep-2013
 *
 * @version 1.0.0
 *
 */
jQuery(function(){
    /*
     * Objetos e variáveis
     */
    var oTable = jQuery("#table-action"),
        bt_novo_action = jQuery("#bt_novo_action")
    ;
    /*
     * Carregamento do grid
     */
    jQuery(document).loadGrid(oTable);
    /*
     * Evento click único na linha do grid.
     */
    jQuery(document).on("click", "#table-action tbody tr", function() {
        var anSelected ='#' + jQuery(this).attr("id");
        if (jQuery(anSelected).hasClass('table-tr-selected')) {
            jQuery(anSelected).removeClass('table-tr-selected');
        }else {
            jQuery('#table-action tbody tr.table-tr-selected').removeClass('table-tr-selected');
            jQuery(anSelected).addClass('table-tr-selected');
        }
    });
    /*
     * Evento clique duplo na linha do grid.
     */
    jQuery(document).on("dblclick", "#table-action tbody tr", function() {
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
                    title    : 'Editar Action',
                    backdrop : false,
                    size     : "m"
                });
            }
        });
    });
    /*
     * Botão novo controller
     */
    bt_novo_action.click(function() {
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
                    title    : 'Cadastrar Ações',
                    backdrop : false,
                    size     : "m"
                });
            }
        });
    });
});