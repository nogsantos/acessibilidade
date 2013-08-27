<?php
/**
 *
 * Descrição: View Helper EmpresaDefault
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 27-Aug-2013
 *
 * @version 1.0.0
 *
 */
class My_View_Helper_EmpresaDefault extends Zend_View_Helper_Abstract  {
    
    protected $id_empresa;
    protected $id_empresaIterator;
    
    public function empresaDefault(){
        try {
            $auth       = Zend_Auth::getInstance();
            $oEmpresa   = new Application_Model_Empresa();
            if ($auth->hasIdentity()) {
                $oEmpresa->setIdEmpresa($auth->getIdentity()->id_empresa);
            }else{
                $oEmpresa->setEmpresaMatriz(true);
            }
            $id_empresa = $oEmpresa->consultarDados();
            $this->id_empresaIterator = new ArrayIterator($id_empresa->toArray());
            return $this;
        } catch (Zend_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);
            $logger->crit($exc->getMessage());
            $r = new Zend_Controller_Action_Helper_Redirector;
            $r->gotoUrl('erro.html')->redirectAndExit();
        }
    }

    /**
     * 
     * @return ArrayIterator
     */
    public function getIterator() {
        $this->id_empresaIterator->rewind();
        return $this->id_empresaIterator;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        return $this->getIterator()->getArrayCopy();
    }

    /**
     * 
     * @return array
     */
    public function toZendForm() {
        try {
            $iterator = $this->getIterator();
            $return = array();
            while ($iterator->valid()) {
                $it = $iterator->current();
                $return[$it['id_empresa']] = $it['nm_empresa'];
                $iterator->next();
            }
            $iterator->rewind();
            return $return;
        } catch (Exception $exc) {
            return false;
        }
    }
    /**
     * 
     * @return array
     */
    public function toView() {
        try {
            $iterator = $this->getIterator();
            $return = array();
            while ($iterator->valid()) {
                $it = $iterator->current();
                $return[$it['id_empresa']] = $it['nm_empresa'];
                $iterator->next();
            }
            $iterator->rewind();
            return $return;
        } catch (Exception $exc) {
            return false;
        }
    }
    /**
     * 
     * @return array
     */
    public function toViewSingle() {
        try {
            $iterator = $this->getIterator();
            return $iterator[0];
        } catch (Exception $exc) {
            return false;
        }
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function getLabel($name = null) {
        $iterator = $this->getIterator();
        foreach ($iterator as $k => $it) {
            if (@$it['id_empresa'] == $name)
                return $it['nm_empresa'];
        }
    }
}
