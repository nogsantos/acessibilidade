<?php
/**
 *
 * Descrição:Classe Usuario
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 20-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Usuario extends Zend_Db_Table_Abstract {
    
    private $_name    = 'usuario';
    private $_primary = array('usuario','login');

    public function logar(){
        
    }
    
}
