<?php

/**
 *
 * Descrição:Classe Modulo
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Modulo extends Zend_Db_Table_Abstract {
     /*
     * Atributos
     */
    protected $_name    = 'modulo';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_modulo';
    protected $sSql;
    protected $idModulo;
    protected $codigoModulo;
    protected $nmModulo;
    protected $descModulo;
    
    public function getIdModulo() {
        return $this->idModulo;
    }

    public function setIdModulo($idModulo) {
        $this->idModulo = $idModulo;
    }

    public function getCodigoModulo() {
        return $this->codigoModulo;
    }

    public function setCodigoModulo($codigoModulo) {
        $this->codigoModulo = $codigoModulo;
    }

    public function getNmModulo() {
        return $this->nmModulo;
    }

    public function setNmModulo($nmModulo) {
        $this->nmModulo = $nmModulo;
    }

    public function getDescModulo() {
        return $this->descModulo;
    }

    public function setDescModulo($descModulo) {
        $this->descModulo = $descModulo;
    }
    /**
     * Consulta os controllers por módulo
     */
    public function retornarMenuDinamico(){
        $this->sSql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('m' => $this->_name),
                       array(
                           'modulo' => 'nm_modulo',
                           'codigo_modulo',
                       ), $this->_schema)
                ->join(array('c'=>'controller'), 
                        'c.fk_modulo = m.id_modulo',
                        array(
                            'controller'=> 'nm_controller',
                            'codigo_controller',
                            'id_controller',
                        ), $this->_schema)
                ->order(array('m.ordem', 'c.ordem'))
        ;
        return $this->fetchAll($this->sSql);
    }
    
}
