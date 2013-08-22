/**
 *
 * Descrição:Script layout
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
jQuery(function(){
    var btMenuSobre = jQuery("#btMenuSobre");
    
    btMenuSobre.click(function(event){
        event.preventDefault();
        /*
         * Chamada para o formulário
         */
        var url = jQuery(this).attr("href");
        jQuery.ajax({
            cache: false,
            url  : url,
            success: function(html, textStatus) {
                if (textStatus === "error"){
                    bootbox.alert(textStatus);
                }else{
                    bootbox.alert(html);
                }
            }
        }); 
    });
});