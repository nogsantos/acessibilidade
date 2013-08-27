<?php
/**
 *
 * Descrição:Classe UserSession
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 26-Aug-2013
 *
 * @version 1.0.0
 *
 */
class UserSession extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'user_session';
    protected $_schema  = 'public';
    protected $_primary = 'session_id';
}
