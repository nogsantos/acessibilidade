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
    var oTable = jQuery('#table-modulo'),
        bt_novo_modulo = jQuery("#bt_novo_modulo"),
        bt_excluir_modulo = jQuery("#bt_excluir_modulo"),
        id_modulo = ""
    ;
    /*
     * Configurações do Grid.
     */
    oTable.dataTable({
        "bJQueryUI"      : true,
        "sPaginationType": "bootstrap",
        "sDom"           : '<"top"fl>rt<"bottom"pi><"clear">',
        "oLanguage"     : {
            "sLengthMenu"  : "_MENU_",
            "sZeroRecords" : "Nenhum registro localizado",
            "sInfo"        : "Visualizando _END_ de _TOTAL_ registros",
            "sInfoEmpty"   : "Visualizando 0 de 0 registros",
            "sInfoFiltered": "(filtro de _MAX_ registros totais)",
            "sSearch"      : ""
        }
    });
    /*
     * Evento click único na linha do grid.
     */
    jQuery(document).on("click", "#table-modulo tbody tr", function() {
        var anSelected ='#' + jQuery(this).attr("id");
        if ( jQuery(anSelected).hasClass('table-tr-selected') ) {
            jQuery(anSelected).removeClass('table-tr-selected');
            bt_excluir_modulo.addClass("disabled");
            id_modulo = "";
        }else {
            jQuery('#table-modulo tbody tr.table-tr-selected').removeClass('table-tr-selected');
            jQuery(anSelected).addClass('table-tr-selected');
            bt_excluir_modulo.removeClass("disabled");
            id_modulo = jQuery(this).attr("id");
        }
    });
    /*
     * Estilo aos campos do grid
     */
    jQuery(".dataTables_filter input").addClass('form-control').attr('placeholder', 'Filtrar registros');
    jQuery(".dataTables_length select").addClass('form-control');
    /*
     * Evento clique duplo na linha do grid.
     */
    jQuery(document).on("dblclick", "#table-modulo tbody tr", function() {
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
                    title    : 'Editar Modulo',
                    backdrop : false,
                    size     : "p"
                });
            }
        });
    });
    /*
     * Botão novo modulo
     */
    bt_novo_modulo.click(function() {
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
                    title    : 'Cadastrar Modulo',
                    backdrop : false,
                    size     : "p"
                });
            }
        });
    });
    /*
     * Botão excluir modulo
     */
    bt_excluir_modulo.click(function() {
        if(id_modulo !== ""){
            var action = baseUrl + '/administrativo/excluir.modulo/id_modulo/'+id_modulo;
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
