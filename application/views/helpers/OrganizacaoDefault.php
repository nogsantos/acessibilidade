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
    
    protected $cnpj_organizacao;
    protected $id_organizacaoIterator;
    
    public function organizacaoDefault(){
        try {
            $auth           = Zend_Auth::getInstance();
            $oOrganizacao   = new Application_Model_Organizacao();
            if ($auth->hasIdentity()) {
                $oOrganizacao->setIdOrganizacao(
                    $auth->getIdentity()->cnpj_organizacao
                );
            }else{
                $oOrganizacao->setOrganizacaoMatriz(true);
            }
            $id_organizacao = $oOrganizacao->consultarDados();
            $this->id_organizacaoIterator = new ArrayIterator(
                $id_organizacao->toArray()
            );
            return $this;
        } catch (Zend_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(Custom_Path::LOG);
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
                $return[$it['cnpj_organizacao']] = $it['nome_organizacao'];
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
                $return[$it['cnpj_organizacao']] = $it['nome_organizacao'];
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
            if (@$it['cnpj_organizacao'] == $name)
                return $it['nome_organizacao'];
        }
    }
}
