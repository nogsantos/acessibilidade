/**
 *
 * Descrição:Script default para formulários
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
     * qTip
     */
    jQuery('[title]').each(function(){
        jQuery(this).qtip({
            style: {
                classes: 'qtip-plain qtip-shadow'
            },
            position: {
                my    : 'center left',
                at    : 'right center',
                target: jQuery(this)
            }
        });
    });
    /*
     * Dialog Erro
     */
    function ajaxErrorDialog(jqXHR) {
        bootbox.dialog(jqXHR.responseText, [], {header: 'ERRO!'});
    }
});