<?php
/**
 *
 * Descrição:Classe Empresa
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 26-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Empresa extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'empresa';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_empresa';
    
    public function listar(){
        $this->sSql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('m' => $this->_name),
                       array(
                           'id_empresa',
                           'nm_empresa',
                       ), $this->_schema)
                ->order('nm_empresa')
        ;
        return $this->fetchAll($this->sSql);
    }
}
