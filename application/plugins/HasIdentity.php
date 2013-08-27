<?php
/**
 * Verifica se há um login ativo no sistema.
 *
 * @author fabricionogueira
 */
class Application_Plugin_HasIdentity extends Zend_Controller_Plugin_Abstract {
    /*
     * Nome do modulo, controlador e acao que o usuario tera acesso 
     * caso nao esteja logado.
     */
    const controller = 'auth';
    const action     = 'login';

    public function preDispatch(Zend_Controller_Request_Abstract $request) {       
            $controller = $request->getControllerName();
            $action     = $request->getActionName();
            /*
             *  Verifica se o usuario nao esta logado
             */
            if (!Zend_Auth::getInstance()->hasIdentity()) {
                /*
                 *  Verifica se a requisicao e diferente do permitido
                 *  Se for diferente rotea para a pagina de login
                 */
                if ($controller != self::controller && $action != self::action) {
                    $request->setControllerName(self::controller);
                    $request->setActionName(self::action);
                }
            }
    }
}