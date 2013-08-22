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
class MenuController extends Zend_Controller_Action {
    
    public function init(){
        
    }
    /*
     * Menu Principal
     */
    public function navigationAction(){
        $this->_helper->viewRenderer->setResponseSegment('navigation');
        $oMenu      = new Application_Model_Modulo();
        $vItensMenu = $oMenu->retornarMenuDinamico();
        $this->view->itensMenu = $vItensMenu;
    }
    /*
     * 
     */
    public function usuarioAction(){
        
    }
}
