<?php
/**
 *
 * Descrição:Classe AdministrativoController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
class AdministrativoController extends Zend_Controller_Action {
    
    public function init(){
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
    }
    /**
     * Index
     */
    public function indexAction(){
         $this->_redirect('index');
    }
    /**
     * Cadastro de modulos
     */
    public function moduloAction(){
        /*
         * Monta o menu do usuário
         */
        $this->_helper->actionStack('usuario', 'Menu');
    }
    /**
     * Cadastro de Controllers
     */
    public function cadControllerAction(){
        
    }
    /**
     * Cadasro de Actions
     */
    public function cadActionAction(){
        /*
         * Monta o menu do usuário
         */
        $this->_helper->actionStack('usuario', 'Menu');
    }
    /**
     * 
     */
    public function cadPerfilUsuarioAction(){
        
    }
}
