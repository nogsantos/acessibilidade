/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(function(){
    var login      = jQuery("#login"),
        loginValid = jQuery("#loginValid"),
        senha      = jQuery("#senha"),
        senhaValid = jQuery("#senhaValid"),
        btLogar    = jQuery("#btLogar");
   /*
    * Focus no login
    **/ 
   jQuery(window).ready(function(){
      login.focus();
   });
   /*
    * validação de campos vazios
    */
   btLogar.click(function(){
       validaLogin();
   });
   /*
    * Função para validar campos
    **/
   function validaLogin(){
       var erros = 0;
       if(jQuery.trim(login.val())==""){
           loginValid.fadeIn("fast");
           login.addClass("form-field-invalid");
           erros = 1;
       }else{
           loginValid.fadeOut("fast");
           login.removeClass("form-field-invalid");
           erros = 0;
       }
       if(jQuery.trim(senha.val())==""){
           senhaValid.fadeIn("fast");
           senha.addClass("form-field-invalid");
           erros = 1;
       }else{
           senhaValid.fadeOut("fast");
           senha.removeClass("form-field-invalid");
           erros = 0;
       }       
       if(erros > 0){
           return false;
       }else{
           document.form.submit();
           return true;
       }
   }
});