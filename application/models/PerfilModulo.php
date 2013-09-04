<?php

/**
 *
 * Descrição:Classe PerfilModulo
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 04-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_PerfilModulo extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'perfil_modulo';
    protected $_schema  = 'administrativo';
    protected $_primary = array('fk_modulo','fk_perfil');
}
