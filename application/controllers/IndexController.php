<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /*
         * Monta o menu principal
         */
//        $this->_helper->actionStack('navigator', 'Menu');
        
    }

    public function indexAction() {
        
    }
    /**
     * Redirecionamento para a pagina inicial do formulario
     */
    public function gridAction() {
        $this->_helper->redirector('index');
    }
    /**
     * 
     */
    public function loginAction() {
        $this->_helper->redirector('login');
    }
}

