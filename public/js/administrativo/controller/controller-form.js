/**
 *
 * Descrição:Script form controller
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 16-Sep-2013
 *
 * @version 1.0.0
 *
 */
jQuery(function(){
    /*
     * Objetos e variáveis
     */
    var formController = jQuery("#formController"),
        div_codigo_controller = jQuery("#div_codigo_controller"),
        codigo_controller = jQuery("#codigo_controller"),
        div_nome_controller = jQuery("#div_nome_controller"),
        nome_controller = jQuery("#nome_controller"),
        div_descricao_controller = jQuery("#div_descricao_controller"),
        descricao_controller = jQuery("#descricao_controller"),
        div_numero_ordem = jQuery("#div_numero_ordem"),
        numero_ordem = jQuery("#numero_ordem"),
        div_data_bloqueio = jQuery("#div_data_bloqueio"),
        data_bloqueio = jQuery("#data_bloqueio"),
        btImprimir = jQuery("#imprimir"),
        btSalvar = jQuery("#salvarController")
    ;
    /*
     * Salvar formulários
     */
    btSalvar.click(function(){
        if(validaCampos()){
            formController.submit();
        }
    });
    /*
     * Valida campos obrigatórios front side.
     */
    function validaCampos(){
        var erros = "";
        jQuery(".form-group").removeClass("has-error");
        if(jQuery.trim(codigo_controller.val())===""){
            erros += '<i class="icon-caret-right"></i> Código<br />';
            div_codigo_controller.addClass("has-error");
        }
        if(jQuery.trim(nome_controller.val())===""){
            erros += '<i class="icon-caret-right"></i> Nome<br />';
            div_nome_controller.addClass("has-error");
        }
        if(erros!==""){
            jQuery(".alert-danger").fadeIn("fast")
                                   .html('<i class="icon-exclamation-sign"></i> Campos obrigatórios:<br />'+erros);
            return false;
        }else{
            return true;
        }
    }
    /**
     * Botão Imprimir
     */
    btImprimir.click(function(){
        window.open(baseUrl + '/administrativo/pdf','Impressão','height=600,width=1024',false);
    });
});