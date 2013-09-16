/**
 *
 * Descrição:Script cad-modulo
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
    var formModulo = jQuery("#formModulo"),
        div_codigo_modulo = jQuery("#div_codigo_modulo"),
        codigo_modulo = jQuery("#codigo_modulo"),
        div_nome_modulo = jQuery("#div_nome_modulo"),
        nome_modulo = jQuery("#nome_modulo"),
        div_descricao_modulo = jQuery("#div_descricao_modulo"),
        descricao_modulo = jQuery("#descricao_modulo"),
        div_numero_ordem = jQuery("#div_numero_ordem"),
        numero_ordem = jQuery("#numero_ordem"),
        div_data_bloqueio = jQuery("#div_data_bloqueio"),
        data_bloqueio = jQuery("#data_bloqueio"),
        btSalvar = jQuery("#salvar")
    ;
    /*
     * 
     */
    btSalvar.click(function(){
        if(validaCampos()){
            formModulo.submit();
        }
    });
    /*
     * Valida campos obrigatórios
     */
    function validaCampos(){
        var erros = "";
        jQuery(".form-group").removeClass("has-error");
        if(jQuery.trim(codigo_modulo.val())===""){
            erros += "- Código<br />";
            div_codigo_modulo.addClass("has-error");
        }
        if(jQuery.trim(nome_modulo.val())===""){
            erros += "- Nome<br />";
            div_nome_modulo.addClass("has-error");
        }
        if(erros!==""){
            jQuery(".alert-danger").fadeIn("fast")
                                   .html("Campos obrigatórios<br />"+erros);
            return false;
        }else{
            return true;
        }
    }
});