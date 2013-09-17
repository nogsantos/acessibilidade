/**
 *
 * Descrição:Script numeros utilizado para tratamento de números no sistema.
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 17-Sep-2013
 *
 * @version 1.0.0
 *
 */
jQuery(function(){
    /**
     * Permite somente números na classe number-only
     */
    jQuery('.number-only').keydown(function(event) {
        var tecla = (window.event) ? event.keyCode : event.which;
        if ((tecla > 47 && tecla < 58) ||
                (tecla >= 96 && tecla <= 105) ||
                (tecla === 9 || tecla === 0)){
            removeErroSomenteNumero(jQuery(this));
            return true;
        }else {
            if (tecla !== 8){
                alertaErroSomenteNumero(jQuery(this));
                return false;
            }else{
                removeErroSomenteNumero(jQuery(this));
                return true;
            }
        }
    });
    /**
     * Alerta o usuário ao tentar digitar string no campo somente número.
     * 
     * @param {Object} campo 
     */
    function alertaErroSomenteNumero(campo){
        campo.popover({
            html     : true,
            trigger  :'hover',
            placement:'top',
            title    :'<i class="icon-warning-sign"></i> Somente Números', 
            content  :'Somente números são aceitos nesse campo.'
        });
        campo.addClass("field-error");
    }
    /**
     * Remove erros.
     * 
     * @param {Object} campo 
     */
    function removeErroSomenteNumero(campo){
        campo.popover('destroy');
        campo.removeClass("field-error");
    }
});