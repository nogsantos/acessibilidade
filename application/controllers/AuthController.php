<?php
/**
 * Description of AuthController
 *
 * @author fabricionogueira
 */
class AuthController extends Zend_Controller_Action {
    
    public function init(){

    }

    public function indexAction() {
        return $this->_helper->redirector('login');
    }
    /**
     * Rotina de login
     */
    public function loginAction() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages  = $this->_flashMessenger->getMessages();
        $form                  = new Form_Login();
        $this->view->form      = $form;
        /*
         * Verifica se existem dados de POST
         */
        try {
            if ($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost();
                if ($form->isValid($data)) {
                    $login     = $form->getValue('login');
                    $senha     = sha1($form->getValue('senha'));
                    $empresa   = $form->getValue('empresa');
                    $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                    /*
                     * Inicia o adaptador Zend_Auth para banco de dados
                     */
                    $authAdapter = new Zend_Auth_Adapter_DbTable(
                            $dbAdapter
                            , 'login'
                            , 'senha'
                            , 'id_empresa'
                    );
                    $authAdapter->setTableName('vw_login_usuario')
                                ->setIdentityColumn('login')
                                ->setCredentialColumn('senha')
                    ;
                    /*
                     * Define os dados para processar o login
                     */
                    $authAdapter->setIdentity($login)
                                ->setCredential($senha)
                    ;
                    $select = $authAdapter->getDbSelect();
                    $select->where('id_empresa = ? ', (int) $empresa);
                    /*
                     * Efetua o login
                     */
                    $auth   = Zend_Auth::getInstance();
                    $result = $auth->authenticate($authAdapter);
                    /*
                     * Verifica se o login foi efetuado com sucesso
                     */
                if ($result->isValid()) {
                        /*
                         * Armazena os dados do usuario em sessao, 
                         * apenas desconsiderando a senha do usuario
                         */
                        $info    = $authAdapter->getResultRowObject(null, 'senha');
                        $storage = $auth->getStorage();
                        $storage->write($info);
                        /*
                         * Redireciona para o Controller protegido
                         */
                        return $this->_helper->redirector->goToRoute(
                            array('controller' => 'index'), null, true
                        );
                    } else {
                        /*
                         * Dados invalidos
                         */
                        $this->_helper->FlashMessenger('
                            <div class="alert alert-danger">
                                Usu&aacute;rio ou senha inv&aacute;lidos!
                            </div>
                        ');
                        $this->_redirect('/auth/login');
                    }
                } else {
                    /*
                     * Formulario preenchido de forma incorreta
                     */
                    $form->populate($data);
                }
            }
        } catch (Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);
            $logger->crit($exc->getMessage());
            $this->_helper->FlashMessenger('
                <div class="alert alert-danger">
                    Erro::0001
                </div>
            ');
            $this->_redirect('/auth/login');
            return false;
        }
    }
    /**
     * Rotina de logout
     */
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        Zend_Session::destroy();
        return $this->_helper->redirector('index');
    }
}