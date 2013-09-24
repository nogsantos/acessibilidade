/**
 *
 * Descrição: Plugin para carregamento padrão do grid para o sistema.
 *
 * @author Fabricio Nogueira
 *
 * @since 24-Sep-2013
 *
 * @version 1.0.0
 * 
 * @param {Object} table id da tabela que deverá receber o grid.
 *
 */
(function($){
    $.fn.loadGrid = function(table){
        return this.each(function(){
            /*
             * Configurações do Grid.
             */
            table.dataTable({
               "bJQueryUI"      : true,
               "sPaginationType": "bootstrap",
               "sDom"           : '<"top"fl>rt<"bottom"p><"clear">',
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
            * Estilo aos campos do grid
            */
           $(".dataTables_filter input").addClass('form-control').attr('placeholder', 'Filtrar registros');
           $(".dataTables_length select").addClass('form-control');
        });
    };
})(jQuery);