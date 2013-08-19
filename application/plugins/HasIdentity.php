<?php
/*
 * Description of HasIdentity
 *
 * @author fabricionogueira
 */
class Application_Plugin_HasIdentity extends Zend_Controller_Plugin_Abstract {
    /*
     * Nome do módulo, controlador e ação que o usuário terá acesso caso não esteja logado.
     */
    const controller = 'auth';
    const action = 'login';

    public function preDispatch(Zend_Controller_Request_Abstract $request) {       
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        /*
         *  Verifica se o usuário não está logado
         */
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            /*
             *  Verifica se a requisição é diferente do permitido
             *  Se for diferente rotea para a página de login
             */
            if ($controller != self::controller && $action != self::action) {
                $request->setControllerName(self::controller);
                $request->setActionName(self::action);
            }
        }
    }
}