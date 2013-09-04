<?php
/**
 *
 * Descrição:Classe PerfilAction
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 04-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_PerfilAction extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'perfil_action';
    protected $_schema  = 'administrativo';
    protected $_primary = array('fk_perfil','fk_action');
}
