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
        $config   = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $vSistema = $config->getOption('configuracao');
        /*
         * Cabeçalhos das páginas
         */
        $this->view->headMeta()->appendName(
            'keywords', 
            'The lunatics is os the grass'
        );
        $this->view->headTitle($vSistema['sistema']['nome'] .' '. $vSistema['sistema']['versao']);
        $this->view->headTitle()->setSeparator(' » ');
    }
}