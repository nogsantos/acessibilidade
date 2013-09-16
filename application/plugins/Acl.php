<?php
/**
 *
 * Descrição:Classe ApplicationAcl
 * Plugin para listagem de controle de acesso (ACL)
 *
 * @author Fabricio Nogueira
 *
 * @since 04-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Application_Plugin_Acl extends Zend_Controller_Plugin_Abstract {

    private $acl;
    private $sistema;
    private $id_pessoa;
    private $perfil;

    public function __construct() {
        /*
         * Carregando os dados da sessao 
         */
        $sessao          = Zend_Auth::getInstance()->getIdentity();
        $this->id_pessoa = $sessao->fk_pessoa;
        $this->perfil    = $sessao->nome_login;
        Custom_Grass_Debug::debugValue($this->id_pessoa, true);
        /*
         * Objeto com as permissões
         */
        Zend_Loader::loadClass('Permissoes');
        $oPermissoes = new Permissoes();
        /*
         * Regras ACL
         */
        $this->acl = new Zend_Acl();
        /*
         * Criação dos perfis
         */
        $vPerfis = $oPermissoes->entPesPerm->consultaPerfisUsuarioPorSistema();
        if (is_array($vPerfis) && !empty($vPerfis)) {
            foreach ($vPerfis as $value) {
                $this->acl->addRole(new Zend_Acl_Role($value['PERFIL']));
            }
        }
        /*
         * Admin perfil default  
         */
        $this->acl->addRole(new Zend_Acl_Role('admin'));
        /*
         * Listando os controllers cadastrados para o sistema.
         */
        $vControllers = $oPermissoes->entPesPerm->consultaControllersSistema();
        if (is_array($vControllers) && !empty($vControllers)) {
            foreach ($vControllers as $value) {
                $this->acl->add(
                    new Zend_Acl_Resource(
                        strtolower($this->sistema->nome) . 
                        ':' . 
                        strtolower($value['CONTROLLER'])
                    )
                );
            }
        }
        /*
         * Controllers default por sistema.
         */
        $this->acl->add(
            new Zend_Acl_Resource(
                strtolower($this->sistema->nome) . ':index'
            )
        );
        $this->acl->add(
            new Zend_Acl_Resource(
                strtolower($this->sistema->nome) . ':Menu'
            )
        );
        $this->acl->add(
            new Zend_Acl_Resource(
                strtolower($this->sistema->nome) . ':sair'
            )
        );
        $this->acl->add(
            new Zend_Acl_Resource(
                strtolower($this->sistema->nome) . ':permissao'
            )
        );
        /*
         * Definir as permissões
         * [perfil],[modulo]:[controller], [action]
         * Método allow é de permissão
         * Método deny é de negação
         * 
         * 
         * Carregando as permissões, 
         * utilizando a mesma consulta para montar o menu.
         */
        $vPermissoes = $oPermissoes->entPesPerm->getMenuDinamico();
        if (is_array($vPermissoes) && !empty($vPermissoes)) {
            $vControllersPermitidos = array();
            foreach ($vPermissoes as $key) {
                if (!empty($key['CONTROLLER'])) {
                    $vControllersPermitidos[$key['CONTROLLER']] = $key['CONTROLLER'];
                }
            }
            foreach ($vControllersPermitidos as $value) {
                foreach ($vPerfis as $perfValue) {
                    $this->acl->allow(
                        array(
                            'admin', 
                            $perfValue['PERFIL']
                        ), 
                        strtolower($this->sistema->nome) . 
                        ':' . 
                        strtolower($value)
                    );
                    /*
                     * Permissão dos controllers default por usuário.
                     */
                    $this->acl->allow(array('admin', $perfValue['PERFIL']), strtolower($this->sistema->nome) . ':index');
                    $this->acl->allow(array('admin', $perfValue['PERFIL']), strtolower($this->sistema->nome) . ':Menu');
                    $this->acl->allow(array('admin', $perfValue['PERFIL']), strtolower($this->sistema->nome) . ':sair');
                    $this->acl->allow(array('admin', $perfValue['PERFIL']), strtolower($this->sistema->nome) . ':permissao');
                }
            }
        } else {
            $this->acl->allow(array('admin'), strtolower($this->sistema->nome) . ':index');
            $this->acl->allow(array('admin'), strtolower($this->sistema->nome) . ':Menu');
            $this->acl->allow(array('admin'), strtolower($this->sistema->nome) . ':sair');
            $this->acl->allow(array('admin'), strtolower($this->sistema->nome) . ':permissao');
        }
    }

    /**
     * preDispatch() is called before an action is dispatched by the dispatcher. 
     * This callback allows for proxy or filter behavior. 
     * By altering the request and resetting its dispatched flag 
     * (via Zend_Controller_Request_Abstract::setDispatched(false)), 
     * the current action may be skipped and/or replaced. 
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        /*
         *  Descobrir qual o modulo, controller e action que o usuário está acessando
         */
        $module     = $request->getModuleName();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();

        if (isset($this->id_pessoa) && !empty($this->id_pessoa)) {
            /*
             * confirma se o controller desejado está habilitado para o perfil 
             */
            if ($this->perfil != 'admin') {
                if (!$this->acl->isAllowed($this->perfil, $module . ':' . $controller, $action)) {
                    $this->getResponse()->setRedirect('permissao');
                }
            }
        } else {
            $this->getResponse()->setRedirect('login');
        }
    }
}
