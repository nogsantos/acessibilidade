<?php
/**
 * Description of MenuController
 *
 * @author fabricionogueira
 */
class MenuController extends Zend_Controller_Action {
    /*
     * Menu Principal
     */
    public function navigatorAction(){
        $this->_helper->viewRenderer->setResponseSegment('menu');
        /*
         * Carrega a classe de permissões para montar o menu e retorna para view.
         */
        Zend_Loader::loadClass('Permissoes');
        $pesPerm = Permissoes::getInstance();
        $vMenu = $pesPerm->getMenuPermissoes();
        $this->view->menu = $vMenu;
    }
}