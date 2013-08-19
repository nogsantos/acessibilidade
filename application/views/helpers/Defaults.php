<?php
/**
 *
 * Descrição: Plugin defaults
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 19-Aug-2013
 *
 * @version 1.0.0
 *
 */
class My_View_Helper_Defaults extends Zend_View_Helper_Abstract{

    public function defaults(){
        /*
         * Cabeçalhos das páginas
         */
        $this->view->headMeta()->appendName(
            'keywords', 
            'The lunatics is os the grass'
        );
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $this->view->headTitle($request->getControllerName())
                   ->headTitle($request->getActionName())
        ;
        $this->view->headTitle()->setSeparator(' / ');
    }
}