<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    /*
     * 
     */
    protected function _initAutoload() {
        $autoloader = new Zend_Application_Module_Autoloader(
                array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => '',
                )
        );
       return $autoloader;
    }
    /**
     * Inicializacao dos plugins
     */
    public function _initPlugins() {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->registerPlugin(new Application_Plugin_HasIdentity());
    }
    /**
     * Retorna o componente Zend_Translate
     * @return type Zend_Translate
     */
    protected function _initTranslate() {
        $resource  = $this->getPluginResource('translate');
        $translate = $resource->getTranslate();
        return $translate;
    }
    /**
     * 
     * @return type Zend_View_Helper
     */
    protected function _initViewHelpers() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        return $view;
    }
}
