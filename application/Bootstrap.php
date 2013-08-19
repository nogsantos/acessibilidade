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
     * Inicialização dos plugins
     */
    public function _initPlugins() {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->registerPlugin(new Application_Plugin_HasIdentity());
    }
}
