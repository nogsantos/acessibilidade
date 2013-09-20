<?php
/**
 *
 * Descrição: Helper view defaults
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
        $this->view->headTitle('Grass 1.0.0');
        $this->view->headTitle()->setSeparator(' » ');
    }
}