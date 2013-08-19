<?php
/*
 * Description of HasIdentity
 *
 * @author fabricionogueira
 */
class Application_Plugin_HasIdentity extends Zend_Controller_Plugin_Abstract {
    /*
     * Nome do m�dulo, controlador e a��o que o usu�rio ter� acesso caso n�o esteja logado.
     */
    const controller = 'auth';
    const action = 'login';

    public function preDispatch(Zend_Controller_Request_Abstract $request) {       
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        /*
         *  Verifica se o usu�rio n�o est� logado
         */
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            /*
             *  Verifica se a requisi��o � diferente do permitido
             *  Se for diferente rotea para a p�gina de login
             */
            if ($controller != self::controller && $action != self::action) {
                $request->setControllerName(self::controller);
                $request->setActionName(self::action);
            }
        }
    }
}