<?php
/**
 *
 * Descrição:Classe Pessoa
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
class PessoaController extends Zend_Controller_Action {
    
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
    public function cadPessoaFisicaAction(){
        /*
         * Monta o menu do usuário
         */
        $this->_helper->actionStack('usuario', 'Menu');
    }
    /**
     * Cadastro de Controllers
     */
    public function cadPessoaJuridicaAction(){
        
    }
    /**
     * Cadasro de Actions
     */
    public function cadUsuarioAction(){
        /*
         * Monta o menu do usuário
         */
        $this->_helper->actionStack('usuario', 'Menu');
    }
    /**/
}
