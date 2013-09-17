/**
 *
 * Descrição:Script default
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
    function ajaxErrorDialog(jqXHR, errorThrown) {
        bootbox.dialog(jqXHR.responseText, [], {header: 'ERRO!'});
    }

    jQuery.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        var postAjax = setTimeout(function() {
            // Recarrega o Timeout
            if (jqXHR.readyState == 4) {
                clearTimeout(postAjax);

                if (originalOptions.dataType != "script" && ((jqXHR.status == 500 && jqXHR.responseText.length > 0) || jqXHR.responseText.length > 0))
                {
                    var timeOut = jQuery("body").data("sessionTimeout")

                    if (!timeOut)
                        return;

                    var ts = new Date();
                    ts.setSeconds(ts.getSeconds() + parseInt(timeOut[2]));
                    ts.setMinutes(ts.getMinutes() + parseInt(timeOut[1]));
                    ts.setHours(ts.getHours() + parseInt(timeOut[0]));

                    if (typeof ts == "object")
                        jQuery('.userTimeout').countdown('option', {until: ts});
                }
            }
        }, 500);
    });
    jQuery.ajaxSetup({
        cache: false,
        error: function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.responseText.length > 0) {
                var html = '';
                try {
                    var tryHtml = eval('(' + jqXHR.responseText + ')')
                    jqXHR.responseText = tryHtml.message;
                } catch (e) {

                }

                ajaxErrorDialog(jqXHR, textStatus);
            }

            return false;
        }
    });
});
/**
 * Retornar a página anterior
 */
function goBack(){
    window.history.back();
}