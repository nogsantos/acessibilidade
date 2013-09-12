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
     * Configurações do Grid.
     */
    var oTable = jQuery('#table-modulo');
    oTable.dataTable({
        "bJQueryUI"      : true,
        "sPaginationType": "bootstrap",
        "sDom"           : '<"top"fl>rt<"bottom"pi><"clear">',
        "oLanguage": {
            "sLengthMenu"  : "_MENU_",
            "sZeroRecords" : "Nenhum registro localizado",
            "sInfo"        : "Visualizando de _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty"   : "Visualizando de 0 a 0 de 0 registros",
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
        }else {
            jQuery('#table-modulo tbody tr.table-tr-selected').removeClass('table-tr-selected');
            jQuery(anSelected).addClass('table-tr-selected');
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
                    size     : "g"
                });
            }
        });
    });
});
