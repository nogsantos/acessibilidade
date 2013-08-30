<?php
/**
 *
 * Descrição: View Helper OrganizacaoDefault
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 27-Aug-2013
 *
 * @version 1.0.0
 *
 */
class My_View_Helper_OrganizacaoDefault extends Zend_View_Helper_Abstract  {
    
    protected $id_organizacao;
    protected $id_organizacaoIterator;
    
    public function organizacaoDefault(){
        try {
            $auth           = Zend_Auth::getInstance();
            $oOrganizacao   = new Application_Model_Organizacao();
            if ($auth->hasIdentity()) {
                $oOrganizacao->setIdOrganizacao($auth->getIdentity()->id_organizacao);
            }else{
                $oOrganizacao->setOrganizacaoMatriz(true);
            }
            $id_organizacao = $oOrganizacao->consultarDados();
            $this->id_organizacaoIterator = new ArrayIterator($id_organizacao->toArray());
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
        $this->id_organizacaoIterator->rewind();
        return $this->id_organizacaoIterator;
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
                $return[$it['id_organizacao']] = $it['nm_organizacao'];
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
                $return[$it['id_organizacao']] = $it['nm_organizacao'];
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
            if (@$it['id_organizacao'] == $name)
                return $it['nm_organizacao'];
        }
    }
}
