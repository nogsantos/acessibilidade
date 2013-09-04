<?php
/**
 *
 * Descrição:Classe Perfil
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 04-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Perfil extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'perfil';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_perfil';
    
}
