<?php
/**
 *
 * Descrição:Classe MenuController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
class IndexController extends MainController {
    /**
     * Init
     */
    public function init(){
        parent::init();
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
    }
    /**
     * View Index
     */
    public function indexAction() {
    }
    /**
     * Redirecionamento para a pagina inicial do formulario
     */
    public function gridAction() {
        $this->_helper->redirector('index');
    }
    /**
     * View Login
     */
    public function loginAction() {
        $this->_helper->redirector('login');
    }
}

