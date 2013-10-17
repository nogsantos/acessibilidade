<?php

/**
 *
 * Descrição:Classe ModuloController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
class ModuloController extends MainController {
    
    public function init(){
        parent::init();
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
    }
    
    public function indexAction(){
        
    }
    
    public function geraMenu(){
        return 'true';
    }
}
